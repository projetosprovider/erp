@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Departamento Detalhes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('departments') }}">Departamentos</a>
                </li>
                <li class="active">
                    <strong>Processos</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="{{route('department_edit', ['id' => $department->uuid])}}" class="btn btn-white btn-xs pull-right">Editar Departamento</a>
                                    <h2>{{$department->name}} </h2>
                                    <small><i class="fa fa-user"></i>    {{$department->user->person->name}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Processos</h5>
                        <div class="ibox-tools">
                            <a href="{{route('process_create')}}" class="btn btn-primary btn-xs">Criar novo Processo</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                            @if($processes->isNotEmpty())
                            <table class="table table-hover">
                                <tbody>
                                @foreach($processes as $process)
                                    <tr>
                                        <td class="project-title">
                                            <a href="{{route('process', ['id' => $process->id])}}">{{$process->name}}</a>
                                        </td>
                                        <td class="project-actions hidden-xs">
                                            <a href="{{route('process_edit', ['id' => $process->id])}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">
                                    Nenhuma tarefa registrada até o momento.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('js')

@endsection
