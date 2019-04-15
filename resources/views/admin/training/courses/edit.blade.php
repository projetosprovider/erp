@extends('layouts.app')

@section('page-title', 'Cursos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Editar Curso </h6>

        <form method="post" action="{{route('courses.update', $course->uuid)}}">

            {{csrf_field()}}
            {{method_field('PUT')}}

            <div class="row m-b-30">
                <div class="col-md-12">

                  <div class="row">

                    <div class="col-md-6">

                        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="title">Titulo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-book"></i></span>
                                </div>
                                <input type="text" id="title" name="title" value="{{ $course->title }}" class="form-control" autofocus placeholder="Informe o titulo">

                            </div>
                            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group {!! $errors->has('workload') ? 'has-error' : '' !!}">
                            <label class="col-form-label" for="workload">Carga Horária</label>
                            <div class="input-group">
                                <input type="number" id="workload" name="workload" value="{{ $course->workload }}" class="form-control" value="10">

                            </div>
                            {!! $errors->first('workload', '<p class="help-block">:message</p>') !!}
                        </div>

                      </div>

                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="description">Descrição</label>
                        <div class="input-group">
                            <textarea name="description" rows="4" class="form-control summernote">{{ $course->description }}</textarea>
                        </div>
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>

                </div>
                <div class="col-md-12">
                  <div class="form-group {!! $errors->has('grade') ? 'has-error' : '' !!}">
                      <label class="col-form-label" for="grade">Grade Curricular</label>
                      <div class="input-group">
                            <textarea name="grade" rows="4" class="form-control summernote">{{ $course->grade }}</textarea>
                      </div>
                      {!! $errors->first('grade', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
            </div>

            <button class="btn btn-custom">Salvar</button>
            <a class="btn btn-default" href="{{ route('courses.index') }}">Cancelar</a>
        </form>

    </div>

@endsection
