<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training\{Team, Course};
use App\Models\Training\Team\Employee as TeamEmployees;
use Illuminate\Support\Facades\Validator;
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

        $team = Team::create($data);

        foreach ($data['employees'] as $key => $employeeID) {
          TeamEmployees::create([
            'team_id' => $team->id,
            'employee_id' => Employee::uuid($employeeID)->id,
          ]);
        }

        return redirect()->route('teams.index');
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
