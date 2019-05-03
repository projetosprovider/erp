@extends('layouts.app')

@section('page-title', 'Turmas')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Nova Turma </h6>

        <form method="post" action="{{route('teams.store')}}">

            {{csrf_field()}}

            <div class="row m-b-30">
                <div class="col-md-12">

                  <div class="row">

                      <div class="col-md-6">

                        <div class="form-group {!! $errors->has('course_id') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="course_id">Curso</label>
                            <div class="input-group">
                              <select class="form-control m-b select2" name="course_id" required>
                                  @foreach($courses->sortBy('name') as $course)
                                        <option value="{{$course->uuid}}">{{$course->title}}</option>
                                  @endforeach
                              </select>
                            </div>
                            {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group {!! $errors->has('teacher_id') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="teacher_id">Instrutor</label>
                            <div class="input-group">
                              <select class="form-control m-b select2" name="teacher_id" required>
                                  @foreach($teachers->sortBy('name') as $teacher)
                                        <option value="{{$teacher->user->uuid}}">{{$teacher->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                            {!! $errors->first('teacher_id', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                      <div class="span5 col-md-4" id="sandbox-container">
                        <label class="col-form-label" for="course_id">Data</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-md form-control inputDate" name="start" value="{{ now()->modify('+1 day')->format('d/m/Y') }}"/>
                            <div class="input-group-append">
                                <span class="input-group-text">Até</span>
                            </div>
                            <input type="text" class="input-md form-control inputDate" name="end" value="{{ now()->modify('+2 day')->format('d/m/Y') }}"/>
                        </div>
                      </div>

                      <div class="col-md-4">

                        <div class="form-group {!! $errors->has('employees') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="employees">Funcionários</label>
                            <div class="input-group">
                              <select class="form-control m-b select2" name="employees[]" multiple placeholder="Informe os Funcionários">
                                  @foreach($companies->sortBy('name') as $company)
                                    <optgroup label="{{ $company->name }}">
                                      @foreach($company->employees as $employee)
                                        <option value="{{$employee->uuid}}">{{$employee->name}}</option>
                                      @endforeach
                                    </optgroup>
                                  @endforeach
                              </select>
                            </div>
                            {!! $errors->first('employees', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                      <div class="col-md-4">

                        <div class="form-group {!! $errors->has('vacancies') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="vacancies">Vagas</label>
                            <div class="input-group">
                                <input type="number" id="vacancies" name="vacancies" class="form-control" value="20" required>

                            </div>
                            {!! $errors->first('vacancies', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                  </div>
                </div>
            </div>

            <button class="btn btn-custom">Salvar</button>
            <a class="btn btn-default" href="{{ route('courses.index') }}">Cancelar</a>
        </form>

    </div>

@endsection
