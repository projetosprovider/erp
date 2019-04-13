<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training\Student;
use App\Models\{Client};
use Illuminate\Support\Facades\Validator;
use Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('view.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $students = Student::paginate();
        return view('admin.training.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermission('create.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $companies = Client::all();

        return view('admin.training.students.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermission('create.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $data = $request->request->all();

        $data['created_by'] = Auth::user()->id;

        $request->validate([
          'name' => 'required|string|max:255',
          'company_id' => 'required',
          'cpf' => 'required|cpf|unique:students',
        ]);

        Student::create($data);

        notify()->flash('Aluno Adicionado!', 'success', [
          'text' => 'Novo Aluno adicionado com sucesso.'
        ]);

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermission('create.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $student = Student::uuid($id);
        $companies = Client::all();

        return view('admin.training.students.show', compact('student', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermission('edit.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $student = Student::uuid($id);
        $companies = Client::all();
        return view('admin.training.students.edit', compact('student', 'companies'));
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
        if(!Auth::user()->hasPermission('edit.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $data = $request->request->all();

        $student = Student::uuid($id);

        $request->validate([
          'name' => 'required|string|max:255',
          'company_id' => 'required',
          'cpf' => 'required|cpf|unique:students,cpf,'.$student->id,
        ]);

        $student->update($data);

        notify()->flash('Aluno Atualizado!', 'success', [
          'text' => 'Aluno atualizado com sucesso.'
        ]);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

          $student = Student::uuid($id);
          $student->delete();

          return response()->json([
            'success' => true,
            'message' => 'Aluno removido com sucesso.'
          ]);

        } catch(\Exception $e) {
          return response()->json([
            'success' => false,
            'message' => $e->getMessage()
          ]);
        }
    }
}
