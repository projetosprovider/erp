@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Cursos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('courses.index') }}">Cursos</a>
                </li>
                <li class="active">
                    <strong>Editar Curso</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Curso</h5>
                    </div>
                    <div class="ibox-content">

                        <form method="post" class="form-horizontal" action="{{route('courses.update', $course->uuid)}}">

                            {{csrf_field()}}
                            {{method_field('PUT')}}

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Titulo</label>
                              <div class="col-sm-10">
                                <input type="text" value="{{ $course->title }}" name="title" class="form-control" autofocus required/>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif

                              </div>
                            </div>

                            <div class="form-group {{ $errors->has('workload') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Carga Horária (horas)</label>
                                <div class="col-sm-10">
                                  <input type="number" name="workload" value="{{ $course->workload }}" min="1" max="200" class="form-control" required/>

                                  @if ($errors->has('workload'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('workload') }}</strong>
                                      </span>
                                  @endif

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                  <textarea name="description" rows="4" class="form-control summernote" required>{{ $course->description }}</textarea>

                                  @if ($errors->has('description'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                                  @endif

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('grade') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Grade Curricular</label>
                                <div class="col-sm-10">
                                  <textarea name="grade" class="form-control summernote">{{ $course->grade }}</textarea>
                                  @if ($errors->has('grade'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('grade') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </div>



                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('courses.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
