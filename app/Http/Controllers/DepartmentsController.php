<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Process;
use App\User;
use Illuminate\Http\Request;
use Request as Req;
use Auth;

class DepartmentsController extends Controller
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
        if(!Auth::user()->hasPermission('view.departamentos')) {
            return abort(403, 'Unauthorized action.');
        }

        $departments = Department::all();
        return view('admin.departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create')->with('users', User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Department::create(Req::all());

        return redirect()->action('DepartmentsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::uuid($id);
        $processes = Process::where('department_id', $id)->get();

        return view('admin.departments.details')
            ->with('department', $department)
            ->with('processes', $processes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.departments.edit')
            ->with('department', Department::uuid($id))
            ->with('users', User::all());
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

        $department = Department::uuid($id);
        $department->update($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Departamento atualizado com sucesso.'
        ]);

        return redirect()->route('departments');;
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
