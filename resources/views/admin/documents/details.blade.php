@extends('layouts.app')

@push('stylesheets')
        <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Mapeamento - {{ $mapper->name }}

            </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('mappings')}}">Mapeamentos</a>
                </li>
                <li class="active">
                    <strong>Detalhes</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">

            <div class="col-lg-2 col-md-4">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Mapeamento Detalhes</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right ">

                            <div class="avatar hidden-xs">
                                <img class="img" src="{{Gravatar::get($mapper->user->email)}}" alt="Avatar">
                            </div>

                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>{{$mapper->user->name}}</strong> @if($mapper->user->department)<small>{{$mapper->user->department->name}}</small>@endif</h4>

                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                      <td>
                                        <b>Tempo Pevisto</b>
                                      </td>
                                      <td>
                                        @if(!empty($mapper->user->weekly_workload))
                                            <b><label class="lead">{{ App\Http\Controllers\HomeController::intToHour($mapper->user->weekly_workload) }}<label></b>
                                        @else
                                            <a class="btn btn-white btn-sm" href="{{ route('user', $mapper->user->id) }}">Definir horario</a>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <b>Tempo Trabalhado</b>
                                      </td>
                                      <td>
                                          <b><label class="lead">{{ $doneTime }}<label></b>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <b>Tempo Total</b>
                                      </td>
                                      <td>
                                        <b><label class="lead">{{ App\Http\Controllers\HomeController::minutesToHour($mapper->tasks->sum('time')) }}<label>
                                      </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-10 col-md-8">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Tarefas</h5>
                      <div class="ibox-tools">

                      </div>
                  </div>
                  <div class="ibox-content">
                      <div class="project-list table-responsive">
                        @if($mapper->tasks->isNotEmpty())

                        {!! App\Http\Controllers\MapperController::tasksDelayed($mapper, $mapper->user); !!}

                        <table class="table table-hover">
                            <tbody>
                            @forelse ($mapper->tasks as $task)

                              @if($task->is_model)
                                @continue
                              @endif


                              <tr {!! App\Http\Controllers\TaskController::taskDelayed($task) !!} >
                                  <td class="project-title">
                                      <a href="{{route('task', ['id' => $task->id])}}">{{$task->name}}</a>
                                      <br/>
                                      @if($task->status->id == 2)
                                      <small>Iniciada em {{$task->begin ? $task->begin->format('d/m/Y H:i') : ''}}</small>
                                      @elseif($task->status->id == 3)
                                      <small>Finalizada em {{$task->end->format('d/m/Y H:i')}}</small>
                                      @else
                                      <small>Criada em {{$task->created_at->format('d/m/Y H:i')}}</small>
                                      @endif
                                      / <small>Cliente: <b>{{$task->owner->name}}</b></small>
                                  </td>
                                  <td class="project-completion hidden-xs">
                                      <small>GUT:  <b>
                                        <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->severity); !!}">{{$task->severity}}</span>
                                        <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->urgency); !!}">{{$task->urgency}}</span>
                                        <span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->trend); !!}">{{$task->trend}}</span>
                                      </b></small>
                                  </td>
                                  <td class="project-completion hidden-xs">
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

                                  <td class="project-title text-center">
                                      Tempo <a>{{ App\Http\Controllers\HomeController::minutesToHour($task->time) }}</a>
                                  </td>
                                  <td class="project-actions">
                                    @if ($task->status_id == 1)
                                      <a href="{{ route('task_initiate', ['id' => $task->id]) }}" class="btn btn-primary btn-sm" onclick="openSwalScreen();"> Iniciar </a>
                                    @elseif ($task->status_id == 2)
                                      <a href="{{route('task_finish', ['id' => $task->id])}}" class="btn btn-success btn-sm" onclick="openSwalScreen();"> Finalizar </a>
                                    @endif
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
    </div>

    <div class="modal inmodal" id="editar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                </div>
                <form action="{{route('user_update', ['id' => $mapper->user->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
