@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Processo Detalhes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Processo Detalhes</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="{{route('process_edit', ['id' => $process->id])}}"
                                       style="margin-left: 4px;"
                                       class="btn btn-white btn-xs pull-right">Editar Processo</a>
                                    <h2>{{$process->name}} </h2>
                                    <small>{{$process->department->name}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Subprocessos</h5>
                        <div class="ibox-tools">
                            <a href="{{route('sub_process_create', ['process' => $process->id])}}" class="btn btn-white btn-xs">Adicionar</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                          @if($subprocesses->isNotEmpty())
                          <table class="table table-hover">
                              <tbody>
                              @foreach ($subprocesses as $subprocess)
                                  <tr>
                                      <td class="project-title">
                                          <a href="{{route('subprocess', ['id' => $subprocess->id])}}">{{$subprocess->name}}</a>
                                          <br/>
                                          <small>{{$subprocess->process->department->name}} / {{$subprocess->process->name}}</small>
                                      </td>
                                      <td class="project-actions hidden-xs">
                                          <a href="{{route('task_create', ['sub_process' => $subprocess->id])}}" class="btn btn-primary btn-sm">Criar Tarefa</a>
                                          <a href="{{route('subprocess', ['id' => $subprocess->id])}}" class="btn btn-white btn-sm"> Visualizar </a>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                          @else
                              <div class="alert alert-warning">
                                  Nenhum sub-processo registrado até o momento.
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
