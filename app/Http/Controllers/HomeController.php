<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskLogs;
use App\Models\Process;
use App\User;
use App\Models\Department;
use Auth;
use Redis;
use Redirect;

use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;
use App\Models\MessageBoard;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::user()->hasPermission('view.painel.principal')) {
            return abort(403, 'Unauthorized action.');
        }

        if(!Auth::user()->active) {
          Auth::logout();
          return Redirect::route('login')->withErrors('Desculpe, mas o Usuário está desativado, entre em contato com o Administrador.');
        }

        $activities = Auth::user()->activities->sortByDesc('id')->take(4);

        $this->createTasksFromProcesses();

        $tasks = Task::where('user_id', Auth::user()->id)->limit(12)->orderBy('id', 'DESC')->get();

        $concluded = $tasks->filter(function($task) {
            return $task->status_id == Task::STATUS_FINALIZADO;
        });

        $date = new \DateTime('now');

        $concludedInThisWeek = $tasks->filter(function($task) use($date) {

            $dateWeekNumber = $date->format('w') - 1;

            if($dateWeekNumber > 0) {
                $date->modify("- {$dateWeekNumber} days");
            }

            return $task->status_id == Task::STATUS_FINALIZADO && $task->end >= $date->format(\DateTime::ISO8601);
        });

        $concludedInThisMount = $tasks->filter(function($task) use($date) {

            $dateDaysNumber = $date->format('d');

            if($dateDaysNumber != 1) {
                $date->modify("- {$dateDaysNumber} days");
            }

            return $task->status_id == Task::STATUS_FINALIZADO && $task->end >= $date->format(\DateTime::ISO8601);
        });

        $concludedInThisMountWithDelay = $concludedInThisMount->filter(function($task) {
            return $task->spent_time > $task->time;
        });

        $spentTime = $tasks->map(function($task) {

            if ($task->status_id != 3) {
                return;
            }

            return (new \DateTime($task->begin))->diff((new \DateTime($task->end)))->format('%i');
        });

        $time = $tasks->map(function($task, $i) {
            return [
                  $i+1,
                  (int)$task->time
              ] ;
        });

        $time2 = $tasks->map(function($task, $i) {
            return [ $i+1,
                  (int)(new \DateTime($task->begin))->diff((new \DateTime($task->end)))->format('%i')
              ] ;
        });

        $peddingTasks = $tasks->filter(function($task) {
            return $task->status->id == Task::STATUS_PENDENTE;
        });

        $percentMount = self::getPercetageDoneTasks($concludedInThisMount, $concludedInThisMountWithDelay);

        $messages = MessageBoard::whereHas('messages', function($query) use($request) {
          $query->where('user_id', $request->user()->id);
        })->orderByDesc('id')->get();

        $messagesWaiting = $messages->filter(function($message) {
            return $message->user->status == 'ENVIADO';
        });

        return view('home', compact('activities', 'messages'))
        ->with('processes', Process::all())
        ->with('users', User::all())
        ->with('departments', Department::all())
        ->with('logs', TaskLogs::limit(6)->orderBy('id', 'DESC')->get())
        ->with('tasks', $tasks)
        ->with('peddingTasks', $peddingTasks)
        ->with('time', $spentTime->toJson())
        ->with('spent', $time->toJson())
        ->with('proposedTime', $time->toJson())
        ->with('spentTime', $spentTime->sum())
        ->with('concluded', $concluded)
        ->with('concludedInThisWeek', $concludedInThisWeek)
        ->with('concludedInThisMount', $concludedInThisMount)
        ->with('concludedInThisMountWithDelay', $concludedInThisMountWithDelay)
        ->with('percentMount', $percentMount);
    }

    public function createTasksFromProcesses()
    {
        $dailyProcesses = Process::where('frequency_id', 2)->get();

        $itens = $dailyProcesses->map(function($subprocesses) {
          return $subprocesses->get()->map(function($tasks) {
            return $tasks->get()->map(function($task) {

                if($task->status_id != Task::STATUS_PENDENTE) {

                    $newTask = new Task();
                    $task->description = $task->description;
                    $task->sub_process_id = $task->sub_process_id;
                    $task->user_id = $task->user_id;
                    $task->time = $task->time;
                    $task->method = $task->method;
                    $task->indicator = $task->indicator;
                    $task->client_id = $task->client_id;
                    $task->vendor_id = $task->vendor_id;
                    $task->severity = $task->severity;
                    $task->urgency = $task->urgency;
                    $task->trend = $task->trend;

                }
            });
          });
        });

    }

    public static function getPercetageDoneTasks($concludedInThisMount, $concludedInThisMountWithDelay)
    {
        return round((count($concludedInThisMountWithDelay)/ !empty($concludedInThisMount) ? count($concludedInThisMount) : 1) * 100, 2);
    }

    public static function minutesToHour($time)
    {
        $hours = floor($time / 60);
        $minutes = ($time % 60);

        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

        if ($hours < 10) {
           $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        }

        return "{$hours}:{$minutes}:00";
    }

    public static function intToHour($hour)
    {
        if(empty($hour)) {
            return;
        }

        return "{$hour}:00:00";
    }
}
