<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;
use App\Models\SubProcesses;
use Auth;

class SubProcessesController extends Controller
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
        $subprocesses = SubProcesses::all();

        return view('admin.subprocesses.index')->with('subprocesses', $subprocesses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subprocesses = [];

        if(\Auth::user()->isAdmin()) {
          $subprocesses = Process::all();
        } else {
          $subprocesses = Process::where('department_id', Auth::user()->department->id)->get();
        }

        return view('admin.subprocesses.create')
        ->with('processes', $subprocesses);
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

        $hasSubProcess = SubProcesses::where('name', $data['name'])->where('process_id', $data['process_id'])->get();

        if($hasSubProcess->isNotEmpty()) {
          flash('Já existe um subprocesso com este mesmo nome para este departamento.')->error()->important();
          return redirect()->back();
        }

        $process = Process::findOrFail($data['process_id']);

        $subprocess = new SubProcesses();
        $subprocess->name = $data['name'];
        $subprocess->process_id = $process->id;

        if($process->is_model) {
          $subprocess->is_model = true;
        }

        $subprocess->save();

        flash('Novo subprocesso adicionado com sucesso.')->success()->important();

        return redirect()->route('process', ['id' => $process->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subprocess = SubProcesses::find($id);

        return view('admin.subprocesses.details')
            ->with('subprocess', $subprocess);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
