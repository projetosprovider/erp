<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training\{Team, Course};
use App\Models\Training\Team\Employee as TeamEmployees;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use App\Models\Client\Employee;
use App\Models\Client as Company;
use App\Models\People;
use App\User;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.training.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::whereHas('employees')->get();
        $courses = Course::where('active', true)->get();
        $teachers = People::where('occupation_id', 9)->get();
        return view('admin.training.teams.create', compact('companies', 'courses', 'teachers'));
    }

    public function schedule($id, Request $request)
    {

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

        $course = Course::uuid($data['course_id']);
        $teacher = User::uuid($data['teacher_id']);

        $data['course_id'] = $course->id;
        $data['teacher_id'] = $teacher->id;

        $data['start'] = \DateTime::createFromFormat('d/m/Y', $data['start']);
        $data['end'] = \DateTime::createFromFormat('d/m/Y', $data['end']);

        $team = Team::create($data);

        foreach ($data['employees'] as $key => $employeeID) {
          TeamEmployees::create([
            'team_id' => $team->id,
            'employee_id' => Employee::uuid($employeeID)->id,
          ]);
        }

        return redirect()->route('teams.show', $team->uuid);
    }

    public function addEmployes($id, Request $request)
    {
        $data = $request->request->all();

        if(count($data['employees']) <= 0) {
            return back();
        }

        $team = Team::uuid($id);

        if($team->vacancies < ($team->employees->count() + count($data['employees']))) {

            notify()->flash('Limite de vagas excedido', 'error', [
              'text' => 'O número de funcionários excede o limite de usuários.'
            ]);

            return back();
        }

        foreach ($data['employees'] as $key => $employeeID) {
          TeamEmployees::create([
            'team_id' => $team->id,
            'employee_id' => Employee::uuid($employeeID)->id,
          ]);
        }

        notify()->flash('Feito', 'success', [
          'text' => 'Funcionários adicionados com sucesso.'
        ]);

        return redirect()->route('teams.show', $team->uuid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::uuid($id);

        $teamCode = Helper::Initials($team->course->title) . $team->id . '-'.$team->start->format('d-m-y');

        $companies = Company::whereHas('employees')->get();
        $employeesSelected = $team->employees->pluck('employee.id')->toArray();

        $courses = Course::where('active', true)->get();
        $teachers = People::where('occupation_id', 9)->get();

        return view('admin.training.teams.schedule', compact('team', 'teamCode', 'companies', 'courses', 'teachers', 'employeesSelected'));
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
        $team = Team::uuid($id);

        $data = $request->request->all();

        $course = Course::uuid($data['course_id']);
        $teacher = User::uuid($data['teacher_id']);

        $data['course_id'] = $course->id;
        $data['teacher_id'] = $teacher->id;

        $data['start'] = \DateTime::createFromFormat('d/m/Y', $data['start']);
        $data['end'] = \DateTime::createFromFormat('d/m/Y', $data['end']);

        $team->update($data);

        return redirect()->route('teams.show', $team->uuid);
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

    public function destroyEmployes($id, $employee, Request $request)
    {
        try {

          $employee = TeamEmployees::uuid($employee);
          $employee->delete();

          return response()->json([
            'success' => true,
            'message' => 'Funcionário removido com sucesso.'
          ]);

        } catch(\Exception $e) {
          return response()->json([
            'success' => false,
            'message' => $e->getMessage()
          ]);
        }
    }
}
