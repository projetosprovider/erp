@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Departamento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('departments') }}">Departamentos</a>
                </li>
                <li class="active">
                    <strong>Novo Departamento</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Novo Departamento</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('department_store')}}">
                            {{csrf_field()}}
                            <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10"><input type="text" name="name" class="form-control" autofocus required/></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Resposável</label>
                                <div class="col-sm-10">
                                  <select class="form-control m-b select2" name="user_id">
                                      @foreach($users as $user)
                                          <option value="{{$user->id}}">{{$user->person->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
