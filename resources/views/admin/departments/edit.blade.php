@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Departamento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('departments') }}">Departamentos</a>
                </li>
                <li class="active">
                    <strong>Editar Departamento</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                @include('flash::message')

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Departamento</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('department_update', ['id' => $department->uuid])}}">
                            {{csrf_field()}}
                            <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10"><input type="text" required name="name" value="{{$department->name}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Resposável</label>
                                <div class="col-sm-10">
                                  <select class="form-control m-b select2" name="user_id" required>
                                      @foreach($users as $user)
                                          <option value="{{$user->id}}" {{ $department->user_id == $user->id ? 'selected' : '' }}>{{$user->person->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('departments') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
