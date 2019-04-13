@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Cargos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('occupations.index') }}">Cargos</a>
                </li>
                <li class="active">
                    <strong>Editar Cargo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Cargo</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('occupations.update', $occupation->uuid)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" name="name" value="{{ $occupation->name }}" class="form-control" autofocus required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Departamento</label>
                                <div class="col-sm-10">
                                  <select class="form-control select2" name="department_id" required>
                                      @foreach($departments as $department)
                                          <option value="{{$department->uuid}}" {{ $department->id == $occupation->department_id ? 'selected' : '' }}>{{$department->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('occupations.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
