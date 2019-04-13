@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Processo</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Editar Processo</strong>
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
                        <h5>Editar Processo</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('process_update', ['id' => $process->id])}}">
                            {{csrf_field()}}
                            <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10"><input type="text" name="name" value="{{$process->name}}" class="form-control"></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>
                                <div class="col-sm-10"><select class="form-control m-b" name="department_id">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{ $department->user_id == $process->id ? 'selected' : '' }}>{{$department->name}}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Frequencia</label>
                                <div class="col-sm-10"><select class="form-control m-b" name="frequency_id">
                                        @foreach($frequencies as $frequency)
                                            <option value="{{$frequency->id}}" {{ $process->frequency_id == $frequency->id ? 'selected' : '' }}>{{$frequency->name}}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
