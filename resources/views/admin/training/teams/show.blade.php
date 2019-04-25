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



                      <div class="col-md-12">

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

                      <div class="col-md-12">

                        <div class="form-group {!! $errors->has('limit_students') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="limit_students">Vagas</label>
                            <div class="input-group">
                                <input type="number" id="limit_students" name="limit_students" class="form-control" value="20" required>

                            </div>
                            {!! $errors->first('limit_students', '<p class="help-block">:message</p>') !!}
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
