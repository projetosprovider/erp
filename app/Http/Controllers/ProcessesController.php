<?php

namespace App\Http\Controllers;

use App\Models\{Department, Client, Mapper};
use App\Models\Task;
use App\Models\Process;
use App\Models\Frequency;
use App\Models\SubProcesses;
use Illuminate\Http\Request;
use Request as Req;
use Auth;

class ProcessesController extends Controller
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
/*
          if(Auth::user()->isAdmin()) {

               if (Req::has('filter')) {
                     $process = Process::where('name', 'like', '%' . Req::get('filter') . '%')->get();
               } else {
                   $process = Process::all();
               }

          } else {

              if (Req::has('filter')) {
                    $process = Process::where('name', 'like', '%' . Req::get('filter') . '%')
                    ->where('department_id', Auth::user()->department_id)->get();
              } else {
                  $process =  Process::where('department_id', Auth::user()->department_id)->get();
              }

          }
*/
          $departments = Department::all();
          $frequencies = Frequency::all();

          $isAdmin = Auth::user()->isAdmin();
          $departmentUser = Auth::user()->department_id;

          return view('admin.processes.index', compact('departments', 'frequencies', 'isAdmin', 'departmentUser'));

    }

    public function indexModels()
    {
/*
          if(Auth::user()->isAdmin()) {

               if (Req::has('filter')) {
                     $process = Process::where('name', 'like', '%' . Req::get('filter') . '%')->get();
               } else {
                   $process = Process::all();
               }

          } else {

              if (Req::has('filter')) {
                    $process = Process::where('name', 'like', '%' . Req::get('filter') . '%')
                    ->where('department_id', Auth::user()->department_id)->get();
              } else {
                  $process =  Process::where('department_id', Auth::user()->department_id)->get();
              }

          }
*/
          $departments = Department::all();
          $frequencies = Frequency::all();

          return view('admin.processes.index-models', compact('departments', 'frequencies'));

    }

    public function toJson($id)
    {
        $process =  Process::find($id);
        return $process->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.processes.create')
        ->with('departments', Department::all())
        ->with('frequencies', Frequency::all());
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

        $hasProcess = Process::where('name', $data['name'])->where('department_id', $data['department_id'])->get();

        if($hasProcess->isNotEmpty()) {
          flash('Já existe um processo com este mesmo nome para este departamento.')->error()->important();
          return redirect()->back();
        }

        $process = new Process();
        $process->name = $data['name'];
        $process->department_id = $data['department_id'];
        $process->frequency_id = $data['frequency_id'];

        if(!empty($data['week_days'])) {
            $days = $data['week_days'];

            foreach($days as $day) {
                $process->$day = true;
            }
        }

        if(!empty($data['time'])) {
            $process->time = $data['time'];
        }

        $process->is_model = true;

        if(!empty($data['range_start']) && !empty($data['range_end'])) {

            $inicio = \DateTime::createFromFormat('d/m/Y', $data['range_start']);
            $fim = \DateTime::createFromFormat('d/m/Y', $data['range_end']);

            $process->range_start = $inicio;
            $process->range_end = $fim;
        }

        $process->save();

        flash('Novo processo adicionado com sucesso.')->success()->important();

        return redirect()->route('processes');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copyClients($id)
    {
      $clients = Client::all();
      $process = Process::findOrFail($id);

      return view('admin.clients.copy', compact('clients', 'process'));
    }

    public function copy(Request $request)
    {

        try {

          $data = $request->request->all();

          if(empty($data['clients'])) {
            flash('Informe ao menos um cliente para continuar o processo.')->error()->important();
            return redirect()->back();
          }

          $id = $data['process_id'];
          #$name = $data['name'];

          foreach ($data['clients'] as $key => $clientId) {

            $client = Client::findOrFail($clientId);
            $process = Process::findOrFail($id);

            $name = $process->name . ' Cliente: ' . $client->name;

            if(empty($id) || empty($name)) {
                flash('Ocorreu um erro inesperado ao copiar o processo.')->error()->important();
                return redirect()->back();
            }

            $someProcess = Process::where('name', $name)->get();

            if($someProcess->isNotEmpty()) {
                flash('Já existe um processo com este mesmo nome.')->error()->important();
                return redirect()->back();
            }

            $process = Process::findOrFail($id);

            $process->subprocesses->map(function($subprocess) use ($process, $client) {

                return $subprocess->tasks->map(function($task) use($subprocess, $client) {

                  if($task->is_model) {

                    $data = [
                        'name' => $subprocess->name,
                        'description' => $task->description,
                        'sub_process_id' => $subprocess->id,
                        'process_id' => $subprocess->process->id,
                        'user_id' => $task->user_id,
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
                        'owner_id' => $client->id,
                    ];

                    $mapper = Mapper::where('user_id', \Auth::user()->id)->get();

                    if($mapper->isNotEmpty()) {
                      $data['mapper_id'] = $mapper->first()->id;
                    }

                    Task::create($data);

                  }

                });

            });

          }


          flash('tarefas criadas com sucesso.')->success()->important();
          return redirect()->route('tasks', ['process_id' => $process->id]);

        } catch(Exception $e) {
            flash('Ocorreu um erro inesperado ao copiar o processo.')->error()->important();
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $processes = SubProcesses::where('process_id', $id);

        return view('admin.processes.details')
            ->with('process', Process::findOrFail($id))
            ->with('subprocesses', $processes->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.processes.edit')
            ->with('departments', Department::all())
            ->with('process', Process::findOrFail($id))
            ->with('frequencies', Frequency::all());
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

        $process = Process::findOrFail($id);

        $process->name = $data['name'];
        $process->department_id = $data['department_id'];

        $process->frequency_id = $data['frequency_id'];

        if(!empty($data['week_days'])) {
            $days = $data['week_days'];

            foreach($days as $day) {
                $process->$day = true;
            }
        }

        if(!empty($data['time'])) {
            $process->time = $data['time'];
        }

        if(!empty($data['range_start']) && !empty($data['range_end'])) {

            $inicio = \DateTime::createFromFormat('d/m/Y', $data['range_start']);
            $fim = \DateTime::createFromFormat('d/m/Y', $data['range_end']);

            $process->range_start = $inicio;
            $process->range_end = $fim;
        }

        $process->save();

        flash('Edição do processo concluída com sucesso.')->success()->important();

        return redirect()->route('processes');
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
}
