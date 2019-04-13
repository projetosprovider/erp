<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use App\Models\TaskModels;
use App\Models\TaskMessages;
use App\Models\Process;
use App\Models\SubProcesses;
use App\User;
use App\Models\TaskLogs;
use App\Models\TaskDelay;
use App\Models\TaskPause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Request as Req;
use App\Models\Mapper;

class TaskController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('is_model', false);

        if(!\Auth::user()->isAdmin()) {
            $tasks->where('user_id', \Auth::user()->id);
        }

        if (Req::has('filter')) {
            $tasks->where('description', 'like', '%' . Req::get('filter') . '%');
        }

        if (Req::has('process_id')) {
            $tasks->where('process_id', Req::get('process_id'));
        }

        if (Req::has('user')) {
            $tasks->where('user_id', Req::get('user'));
        }

        $tasks = $tasks->paginate(10);

        return view('admin.tasks.index')->with('tasks', $tasks);
    }

    public function calendar()
    {
        $tasks = Task::all();

        return view('admin.tasks.calendar')
        ->with('tasks', $tasks);
    }

    public function getTasks()
    {
        $tasks = Task::where('status_id', 1)->get();

        $dados = [];

        $date = new \DateTime('now');

        foreach ($tasks as $task) {

          $inter = $date;
          $end = $inter->modify("+" . $task->time . " minutes");

          $dados[] = [
            'nome' => $task->description,
            'start' => $date->format('Y-m-d H:i'),
            'end' => $end->format('Y-m-d H:i')
          ];
        }

        return json_encode($dados);
    }

    public function showBoard()
    {
        return view('admin.tasks.board')->with('tasks', Task::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if(!Auth::user()->isAdmin()) {
            $mapings = Mapper::where('user_id', Auth::user()->id)->orderBy('id')->get();
            $subprocesses = SubProcesses::where('process_id', Auth::user()->department_id)->get();
        } else {
            $mapings = Mapper::orderBy('id')->get();

        }*/

        $subprocesses = SubProcesses::all();

        return view('admin.tasks.create')
            ->with('subprocesses', $subprocesses)
            ->with('users', User::all())
            ->with('departments', Department::all());
    }

    public static function hourToMinutes($hours)
    {
        $tempo = \DateTime::createFromFormat('H:i', $hours);

        $hora = $tempo->format('H');
        $minutos = $tempo->format('i');

        $time = $minutos;

        if (!empty($hora)) {
            $time += $hora*60;
        }

        return $time;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
          'description' => 'required|max:255',
          'sub_process_id' => 'required',
          'user_id' => 'required',
          'time' => 'required',
          'client_id' => 'required',
          'vendor_id' => 'required',
          'severity' => 'required',
          'urgency' => 'required',
          'trend' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $subprocess = SubProcesses::findOrFail($data['sub_process_id']);

        $taskmodel = TaskModels::where('description', $data['description'])->where('sub_process_id', $data['sub_process_id'])->get();

        $name = $subprocess->name;

        #if($taskmodel->isEmpty()) {
            $data = [
                'name' => $name,
                'description' => $data['description'],
                'sub_process_id' => $data['sub_process_id'],
                'process_id' => $subprocess->process->id,
                'user_id' => $data['user_id'],
                'time' => $this->hourToMinutes($data['time']),
                'method' => $data['method'],
                'indicator' => $data['indicator'],
                'client_id' => $data['client_id'],
                'vendor_id' => $data['vendor_id'],
                'severity' => $data['severity'],
                'urgency' => $data['urgency'],
                'trend' => $data['trend'],
                'status_id' => Task::STATUS_PENDENTE,
                'created_by' => Auth::user()->id,
            ];

            #TaskModels::create($data);
        #}

        if($subprocess->is_model) {
          $data['is_model'] = true;
        }

        $task = Task::create($data);

        if(!$subprocess->is_model) {
          $log = new TaskLogs();
          $log->task_id = $task->id;
          $log->user_id = Auth::user()->id;
          $log->message = 'Criou a tarefa ' . $task->description;
          $log->save();
        }

        flash('Nova tarefa adicionada com sucesso.')->success()->important();

        if($subprocess->is_model) {
          return redirect()->route('processes');
        }

        return redirect()->route('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            $task = Task::findOrFail($id);

            $horaAtual = new \DateTime('now');
            $horaCorte = new \DateTime($task->begin);

            $diff = $horaAtual->diff($horaCorte);
            $segundos = $diff->s + ($diff->i * 60) + ($diff->h * 60);

            $remainTime = ($task->time*60) - $segundos;

            $taskPause = TaskPause::where('task_id', $task->id)->first();

            if(!empty($taskPause)) {

              if(empty($taskPause->end)) {
                $diff2 = $horaAtual->diff(new \DateTime($taskPause->begin));
              } else {
                $base = new \DateTime($taskPause->end);
                $diff2 = $base->diff(new \DateTime($taskPause->begin));
              }

                $segundos2 = $diff2->s + ($diff2->i * 60) + ($diff2->h * 60 * 60);

                $remainTime = $remainTime + $segundos2;
            }

            //echo $remainTime;

            $gut = ($task->severity * $task->urgency * $task->trend);

            if (Req::get('status') == Task::STATUS_EM_ANDAMENTO && $task->status_id != Task::STATUS_EM_ANDAMENTO) {

                if($task->mapper && $task->mapper->active != 1) {
                    return redirect()->back()->with('message', 'Esta tarefa Pertence a um mapeamento, deve primeiro iniciá-lo.');
                }

                $task->status_id = Task::STATUS_EM_ANDAMENTO;
                $task->begin = new \DateTime('now');
                $task->save();

                $log = new TaskLogs();
                $log->task_id = $task->id;
                $log->user_id = Auth::user()->id;
                $log->message = 'Alterou o status da tarefa ' . $task->description . ' para Em Andamento.';
                $log->save();

                return redirect()->route('task', ['id' => $task->id]);
            } elseif (Req::get('status') == Task::STATUS_FINALIZADO && $task->status_id != Task::STATUS_FINALIZADO) {

                $task->status_id = Task::STATUS_FINALIZADO;
                $task->end = new \DateTime('now');
                $horaInicio = new \DateTime($task->begin);
                $diff = $task->end->diff($horaInicio);
                $minutos = $diff->i + ($diff->h * 60);

                $task->spent_time = $minutos;

                $task->save();

                $log = new TaskLogs();
                $log->task_id = $task->id;
                $log->user_id = Auth::user()->id;

                if (0 > $remainTime) {
                  $msg = 'Finalizou a tarefa ' . $task->description . ' com atraso.';
                } else {
                  $msg = 'Alterou o status da tarefa ' . $task->description . ' para Finalizado.';
                }

                $log->message = $msg;
                $log->save();

                return redirect()->route('task', ['id' => $task->id]);
            }

            if (Req::get('cancel')) {
                $task->status_id = Task::STATUS_CANCELADO;
                $task->begin = $task->end = new \DateTime('now');
                $task->save();

                $log = new TaskLogs();
                $log->task_id = $task->id;
                $log->user_id = Auth::user()->id;
                $log->message = 'Alterou o status da tarefa ' . $task->description . ' para Cancelado.';
                $log->save();

                return redirect()->route('task', ['id' => $task->id]);
            }

             if (Req::has('duplicate')) {

                $user = Auth::user()->isAdmin() ? $task->user_id : Auth::user()->id;

                $subprocess = SubProcesses::find($task->sub_process_id);

                $data = [
                    'name' => $subprocess->name,
                    'sub_process_id' => $task->sub_process_id,
                    'user_id' => $user,
                    'frequency' => $task->frequency,
                    'time' => $task->time,
                    'method' => $task->method,
                    'indicator' => $task->indicator,
                    'client_id' => $task->client_id,
                    'vendor_id' => $task->vendor_id,
                    'severity' => $task->severity,
                    'urgency' => $task->urgency,
                    'trend' => $task->trend,
                    'status_id' => Task::STATUS_PENDENTE,
                    'created_by' => Auth::user()->id,
                ];

                $newTask = Task::create($data);

                $this->log($task, 'Duplicou a tarefa ' . $task->description);

                $this->log($newTask, 'Criou a tarefa ' . $newTask->description);

                return redirect()->route('task', ['id' => $newTask->id]);
            }

            $taskDelay = TaskDelay::where('task_id', $task->id)->first();
            $pausedTask = TaskPause::where('task_id', $task->id)->where("end", null)->first();

        } catch(Exception $e) {

            return response()->view('errors.custom', [], 404);

        }

        return view('admin.tasks.details')
            ->with('task', $task)
            ->with('gut', $gut)
            ->with('taskDelay', $taskDelay)
            ->with('pausedTask', $pausedTask)
            ->with('remainTime', $remainTime)
            ->with('processes', Process::all())
            ->with('logs', TaskLogs::where('task_id', $id)->orderBy('id', 'DESC')->get())
            ->with('messages', TaskMessages::where('task_id', $id)->get());
    }

    public function log(Task $task, $message)
    {
        $log = new TaskLogs();
        $log->task_id = $task->id;
        $log->user_id = Auth::user()->id;
        $log->message = $message;
        $log->save();
    }

    public function pause($id)
    {
        $task = Task::find($id);

        $taskPause = new TaskPause();
        $taskPause->task_id = $task->id;
        $taskPause->user_id = Auth::user()->id;
        $taskPause->message = Req::input('message');
        $taskPause->begin = new \DateTime('now');
        $taskPause->save();

        $this->log($task, 'Pausou a tarefa ' . $task->description);
    }

    public function unPause($id)
    {
        $pausedTask = TaskPause::find($id);
        $pausedTask->end = new \DateTime('now');
        $pausedTask->save();

        $this->log($pausedTask->task, 'Continuou a tarefa ' . $pausedTask->task->description);
    }

    public function finish($id)
    {
        $task = Task::findOrfail($id);

        $task->status_id = Task::STATUS_FINALIZADO;
        $task->end = new \DateTime();

        $task->save();

        $this->log($task, ' Finalizou a tarefa a tarefa ' . $task->description);

        flash('A tarefa foi finalizada com sucesso.')->success()->important();

        return redirect()->back();
    }

    public static function getColorFromValue($value)
    {
          switch ($value) {
            case 2:
                return 'primary';
            case 3:
                return 'success';
            case 4:
                return 'warning';
            case 5:
                return 'danger';
            default:
                return 'default';
          }
    }

    public function startTask($id)
    {
        $task = Task::findOrfail($id);

        $task->status_id = Task::STATUS_EM_ANDAMENTO;
        $task->begin = new \DateTime();

        $task->save();

        flash('A tarefa foi iniciada com sucesso.')->success()->important();

        return redirect()->back();
    }

    public static function taskDelayed($task)
    {
        $dateTime = new \DateTime('now');
        $start = $task->begin;

        if($task->status->id != 2) {
          return;
        }

        if(empty($start)) {
          return;
        }

        return $dateTime > $start ? 'class="danger" data-toggle="tooltip" data-placement="bottom" title="Tarefa Atrasada"' : '';
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $time = 0;

         $hours = floor($task->time / 60);
         $minutes = ($task->time % 60);

         if ($hours < 10) {
            $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
         }

         $subprocesses = SubProcesses::all();

         return view('admin.tasks.edit')
            ->with('task', $task)
            ->with('time', "{$hours}:{$minutes}")
            ->with('subprocesses', $subprocesses)
            ->with('processes', Process::all())
            ->with('users', User::all())
            ->with('departments', Department::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $task = Task::findOrFail($id);

        $subprocess = SubProcesses::findOrFail($data['sub_process_id']);

        $userId = $data['user_id'];

        if($data['user_id'] == 'random') {
            $user = User::where('do_task', true)->get()->random();
            $userId = $user->id;
        }

        $data = [
            'name' => $subprocess->name,
            'description' => $data['description'],
            'sub_process_id' => $data['sub_process_id'],
            'user_id' => $userId,
            'time' => $this->hourToMinutes($data['time']),
            'method' => $data['method'],
            'indicator' => $data['indicator'],
            'client_id' => $data['client_id'],
            'vendor_id' => $data['vendor_id'],
            'severity' => $data['severity'],
            'urgency' => $data['urgency'],
            'trend' => $data['trend']
        ];

        $task->description = $data['description'];
        $task->sub_process_id = $data['sub_process_id'];
        $task->user_id = $data['user_id'];
        $task->time = $data['time'];
        $task->method = $data['method'];
        $task->indicator = $data['indicator'];
        $task->client_id = $data['client_id'];
        $task->vendor_id = $data['vendor_id'];
        $task->severity = $data['severity'];
        $task->urgency = $data['urgency'];
        $task->trend = $data['trend'];
        $task->save();

        $log = new TaskLogs();
        $log->task_id = $task->id;
        $log->user_id = Auth::user()->id;
        $log->message = 'Editou a tarefa ' . $task->description;
        $log->save();

        flash('A tarefa foi editada com sucesso.')->success()->important();

        return redirect()->route('task', ['id' => $task->id]);
    }

    public function delay(Request $request, $id)
    {
      try {
        $data = $request->request->all();

        $task = Task::find($id);

        $taskDelay = new TaskDelay();
        $taskDelay->user_id = Auth::user()->id;
        $taskDelay->message = $data['message'];
        $taskDelay->task_id = $id;
        $taskDelay->save();

        $log = new TaskLogs();
        $log->task_id = $task->id;
        $log->user_id = Auth::user()->id;
        $log->message = 'Adicionou o motivo do atraso com a tarefa ' .
        $task->description . ' motivo: ' . $data['message'];
        $log->save();

        return response()->json([
            'class' => 'Sucesso',
            'message' => 'O motivo foi enviado com sucesso.'
        ]);
      } catch(Exception $e) {
        return response()->json([
            'class' => 'Erro',
            'message' => $e->getMessage()
        ]);
      }
    }

    public static function toGraph()
    {
        $date = new \DateTime('now');
        $lastMonth = $date->modify('-1 month');
        $selectedDate = (string)$lastMonth->format('Y-m-d H:i:s');
        $itens = [];

        $tasks = Task::where('created_at', '>', $selectedDate)->get();

        $tasks = $tasks->toArray();

        $itensAtTime = 0;
        $itensDelayed = 0;

        foreach ($tasks as  $task) {

            if($task['status_id'] != Task::STATUS_FINALIZADO) {
                continue;
            }

            $dateTime = (new \DateTime($task['created_at']))->format('Y, m, d');

            if ($task['spent_time'] < $task['time']) {

                $itensAtTime++;

                $itens['atTime'][$dateTime] = $itensAtTime;

                continue;
            }

            $itensDelayed++;

            $itens['delay'][$dateTime] = $itensDelayed;
        }

        return json_encode($itens);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function ociousTime($mapperID)
    {
        $mapper = Mapper::find($mapperID);

        $user = User::find($mapper->user->id);

        $week = 44;
        $days = 5;

        $time = ($week) * 60;

        $workTime = $mapper->tasks->sum('time');

        /*
        $workTime = $mapper->tasks->filter(function($task) {
            return $task->status->id == 2 || $task->status->id == 3;
        })->sum('time');
        */

        $rest = $time - $workTime;

        if(0 > $rest) {
          echo '<span class="label label-primary"><i class="fa fa-thumbs-up"></i> Sem tempo ocioso.</span>';
          return;
        }

        return HomeController::minutesToHour($rest);
    }

    public static function existsTaskByClient($client, $process)
    {
        $hasTasks = Task::where('owner_id', $client->id)->where('process_id', $process->id)->whereIn('status_id', [1,2])->get();

        return $hasTasks->isNotEmpty();
    }

    public static function existsTaskByProcess($process)
    {
        $hasTasks = Task::where('process_id', $process->id)->get();

        return $hasTasks->isNotEmpty();
    }
}
