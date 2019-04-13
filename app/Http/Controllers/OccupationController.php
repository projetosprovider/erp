<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Department\Occupation;
use Auth;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::user()->hasPermission('view.cargos')) {
            return abort(403, 'Unauthorized action.');
        }

        if($request->has('department')) {
            $department = Department::uuid($request->get('department'));
            $occupations = $department->occupations;
        } else {
            $occupations = Occupation::all();
        }

        return view('admin.occupation.index', compact('occupations'));
    }

    public function search(Request $request)
    {
        $id = $request->get('param');

        try {

          $department = Department::uuid($id);

          return response()->json([
            'success' => true,
            'message' => 'Registros retornados',
            'data' => $department->occupations
          ]);

        } catch(\Exception $e) {

          activity()
         ->causedBy($request->user())
         ->log('Erro ao buscar cargos do departamento: '. $e->getMessage());

          return response()->json([
            'success' => false,
            'message' => 'Ocorreu um erro inesperado',
            'data' => []
          ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.occupation.create', compact('departments'));
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

        $department = Department::uuid($data['department_id']);
        $data['department_id'] = $department->id;

        Occupation::create($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Novo Cargo adicionado com sucesso.'
        ]);

        return redirect()->route('occupations.index', ['department' => $department->uuid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $occupation = Occupation::uuid($id);
        return view('admin.occupation.edit', compact('departments', 'occupation'));
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

        $department = Department::uuid($data['department_id']);
        $data['department_id'] = $department->id;

        $occupation = Occupation::uuid($id);
        $occupation->update($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Cargo atualizado com sucesso.'
        ]);

        return redirect()->route('occupations.index', ['department' => $department->uuid]);
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
