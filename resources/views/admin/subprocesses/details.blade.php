@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Sub Processo Detalhes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Sub Processo Detalhes</strong>
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
                                    <a href="{{route('sub_process_edit', ['id' => $subprocess->id])}}"
                                       style="margin-left: 4px;"
                                       class="btn btn-white btn-xs pull-right">Editar Sub Processo</a>
                                    <h2>{{$subprocess->name}} </h2>
                                    <small>{{$subprocess->process->name}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Tarefas</h5>
                        <div class="ibox-tools">
                            <a href="{{route('task_create', ['sub_process' => $subprocess->id])}}" class="btn btn-primary btn-xs">Criar Tarefa</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">

                            <div class="col-md-12">
                              <form metho="get" action="#">
                                  <div class="input-group"><input type="text" name="filter" placeholder="Pesquisar" class="input-sm form-control"> <span class="input-group-btn">
                                      <button type="submit" class="btn btn-sm btn-primary"> Ir!</button> </span></div>
                                  </form>
                            </div>
                        </div>

                        <div class="project-list">
                          @if($subprocess->tasks->isNotEmpty())
                          <table class="table table-hover">
                              <tbody>
                              @forelse ($subprocess->tasks as $task)
                                  <tr>
                                      <td class="project-title">
                                          <a href="{{route('task', ['id' => $task->id])}}">{{$task->description}}</a>
                                          <br/>
                                          <small>Criada em {{$task->created_at->format('d/m/Y H:i')}}</small>
                                      </td>
                                      <td class="project-completion">
                                          <small>GUT:  <b>
                                            <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->severity); !!}">{{$task->severity}}</span>
                                            <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->urgency); !!}">{{$task->urgency}}</span>
                                            <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->trend); !!}">{{$task->trend}}</span>
                                          </b></small>
                                      </td>
                                      <td class="project-completion">
                                          <small>Situação  <b>{{$task->status->name}}</b></small>
                                          <div class="progress progress-mini">
                                              <div style="width:
                                              @if ($task->status_id == 1) 0%
                                              @elseif ($task->status_id == 2) 50%
                                              @elseif ($task->status_id == 3 || $task->status_id == 4) 100%
                                              @endif;" class="progress-bar
                                              @if ($task->status_id == 2) progress-bar-warning
                                              @elseif ($task->status_id == 4) progress-bar-danger
                                              @endif;"></div>
                                          </div>
                                      </td>
                                      <td class="project-people hidden-xs">
                                          <a href="{{route('user', ['id' => $task->sponsor->id])}}">
                                          <img alt="image" class="img-circle" src="{{Gravatar::get($task->sponsor->email)}}"></a>
                                      </td>
                                      <td class="project-actions hidden-xs">
                                          <a href="{{route('task', ['id' => $task->id])}}" class="btn btn-white btn-sm"> Visualizar </a>
                                      </td>
                                  </tr>
                                  @empty
                                  <tr>
                                      <td>Nenhuma tarefa até o momento.</td>
                                  </tr>
                              @endforelse
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
