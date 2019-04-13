<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Okipa\LaravelTable\Table;
use App\Models\Client;
use App\Models\Client\Employee;
use Auth;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new Table)
          ->model(Employee::class)
          ->routes(['index' => ['name' => 'employees.index']]);
        $table->column('name')->title('Name')->sortable()->searchable();
        $table->column('cpf')->title('CPF')->sortable()->searchable();
        $table->column('phone')->title('Telefone')->sortable()->searchable();
        $table->column('email')->title('E-mail')->sortable()->searchable();

        return view('admin.clients.employees.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(!Auth::user()->hasPermission('create.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $companies = Client::all();
        $company = Client::uuid($id);

        return view('admin.clients.employees.create', compact('company', 'companies'));
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'phone' => 'string|max:20',
            'company_id' => 'required',
            'cpf' => 'required|cpf|unique:employees',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $company = Client::uuid($data['company_id']);
        $data['company_id'] = $company->id;
        $data['created_by'] = $request->user()->id;
        $data['active'] = $request->has('active');

        Employee::create($data);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Novo Funcionário adicionado ao Cliente com sucesso.'
        ]);

        return redirect()->route('clients.show', $company->uuid);
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
    public function edit($id, $employee)
    {
        if(!Auth::user()->hasPermission('edit.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $companies = Client::all();
        $company = Client::uuid($id);
        $employee = Employee::uuid($employee);

        return view('admin.clients.employees.edit', compact('company', 'companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $employee)
    {
        if(!Auth::user()->hasPermission('edit.alunos')) {
            return abort(403, 'Unauthorized action.');
        }

        $data = $request->request->all();

        $employee = Employee::uuid($employee);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,'.$employee->id,
            'phone' => 'string|max:20',
            'company_id' => 'required',
            'cpf' => 'required|cpf|unique:employees,cpf,'.$employee->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //dd($data);

        $company = Client::uuid($data['company_id']);
        $data['company_id'] = $company->id;
        $data['active'] = $request->has('active');

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Funcionário atualizado com sucesso.'
        ]);

        return redirect()->route('clients.show', $company->uuid);
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
