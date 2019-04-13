<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapper;
use App\User;
use App\Models\Task;
use App\Models\MapperTasks;
use Request as Req;
use Illuminate\Validation\Validator;
use Auth;
use App\Helpers\Mapper as MapperHelper;

class MapperController extends Controller
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
        if(Auth::user()->isAdmin()) {

            $users = User::all();

            foreach ($users as $user) {

                $mapping =  Mapper::where('user_id', $user->id)->get();

                if($mapping->isNotEmpty()) {

                    $this->setTasks($mapping->first());
                    continue;
                }

                $mapper = new Mapper();
                $mapper->name = $user->name;
                $mapper->user_id = $user->id;
                $mapper->status_id = 2;
                $mapper->save();

                $this->setTasks($mapper);

            }

            $mappings =  Mapper::all();

        } else {
            $mappings =  Mapper::where('user_id', Auth::user()->id)->get();
        }

        return view('admin.mappings.index', compact('mappings'));
    }

    public function setTasks($mapper)
    {
        $tasks = Task::where('status_id', 1)->where('user_id', $mapper->user->id)->where('mapper_id', null)->get();

        foreach ($tasks as $task) {

            if($task->is_model) {
              continue;
            }

            $task->mapper_id = $mapper->id;
            $task->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()) {
            $users =  User::all();
        } else {
            $users =  User::where('id', Auth::user()->id)->get();
        }

        return view('admin.mappings.create')
        ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Req::all();

        if(empty($data['name'])) {

          $user = User::find($data['user']);

          $data['name'] = "Mapeamento Semana " . date('W') . " para " . $user->name;
        }

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
          'name' => 'required|max:255|unique:mappers',
          'user' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $hasMapperWithUser = Mapper::where('user_id', $data['user'])->where('active', 1)->first();

        if ($hasMapperWithUser) {
            return back()->withErrors('Já existe um mapeamento ativo para este usuário.');
        }

        $mapper = new Mapper();

        $mapper->name = $data['name'];
        $mapper->user_id = $data['user'];
        $mapper->status_id = 1;
        $mapper->save();

        return redirect()->action('MapperController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mapper = Mapper::findOrFail($id);

        $tasks = Task::where('status_id', 1)->where('status_id', 2)->where('user_id', $mapper->user->id)->where('mapper_id', null)->get();

        foreach ($tasks as $task) {

            if($task->is_model) {
              continue;
            }

            $task->mapper_id = $mapper->id;
            $task->save();
        }

        $doneTime = MapperHelper::getDoneTime($mapper);

        return view('admin.mappings.details', compact('mapper', 'doneTime'));
    }

    public function addTask($id)
    {
      $tasks = Task::where('status_id', 1)->where('mapper_id', null)->get();
      $mapper = Mapper::findOrFail($id);

      //dd($tasks->toArray());

        return view('admin.mappings.add-task')
        ->with('mapper', $mapper)
        ->with('tasks', $tasks);
    }

    public function addTaskStore()
    {
        $data = Req::all();

        foreach($data['ids'] as $item) {
            $mTask = Task::findOrFail($item);
            $mTask->mapper_id = $data['mapper'];
            $mTask->user_id = $data['user'];
            $mTask->save();
        }

        return redirect()->route('mapping', ['id' => $data['mapper']]);
    }

    public function removeTaskStore($id, $task)
    {
        $mTask = Task::findOrFail($task);
        $mTask->mapper_id = null;
        $mTask->save();

        return redirect()->route('mapping', ['id' => $id]);
    }

    public function start($id)
    {
        $mapper = Mapper::findOrFail($id);
        $mapper->started_at = new \DateTime('now');
        $mapper->status_id = 2;

        $mapper->save();

        return redirect()->route('mapping', ['id' => $id]);
    }

    public function done($id)
    {
        $mapper = Mapper::findOrFail($id);
        $mapper->closed_at = new \DateTime('now');
        $mapper->status_id = 4;

        $mapper->save();

        return redirect()->route('mapping', ['id' => $id]);
    }

    public function cancel($id)
    {
        $mapper = Mapper::findOrFail($id);
        $mapper->closed_at = new \DateTime('now');
        $mapper->status_id = 3;

        $mapper->save();

        return redirect()->route('mapping', ['id' => $id]);
    }

    public function taskToDo($id)
    {
        $mapping = Mapper::findOrFail($id);
        $tasks = $mapping->tasks()->get();

        $resultado = $tasks->filter(function($task) {
            return $task->status_id == 1 || $task->status_id == 2;
        });

        $resultado = $resultado->map(function($task) {
            $link = route('task', ['id' => $task->id]);

            return [
                'nome' => "<a href={$link} class='text-navy'>".$task->name."</a>",
                'duracao' => HomeController::minutesToHour($task->time),
            ];
        });


      /*  $tasks = Task::where('mapper_id', $id)->get();*/

        return json_encode($resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(500);
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
        //
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

    public static function tasksDelayed($mapper, $user)
    {
        #$user = Auth::user();

        $route = route('user', ['id' => $user->id]);

        if(is_null($user->end_day)) {
           return '<div class="alert alert-warning">Adicione um horário para este usuário.  <a class="btn btn-white btn-sm pull-right" href="'.$route.'">Acessar</a></div>';
        }

        $timeTasks = $mapper->tasks->filter(function($task) {
          return $task->status->id == 1 || $task->status->id == 2;
        })->sum('time');

        if(empty($timeTasks)) {
          return '<div class="alert alert-warning">Usuário sem tarefas.</div>';
        }

        $time = \DateTime::createFromFormat('H:i:s', $user->end_day);
        $saida = $time;
        $horario = new \DateTime('now');

        $tempoRestante = $horario->diff($saida);

        $tempoHora = $tempoMinutos = 0;

        if($tempoRestante->h) {
          $tempoHora = $tempoRestante->h*60;
        }

        $tempoMinutos = $tempoRestante->i + $tempoHora;

        return $timeTasks > $tempoMinutos ? '<div class="alert alert-warning">Você pode não terminar as tarefas antes do seu expediente terminar, horario de saída: ' . $time->format('H:i:s') . '!</div>' : '';
    }
}
