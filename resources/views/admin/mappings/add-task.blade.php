@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Mapeamentos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Mapeamentos</strong>
                </li>
            </ol>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Mapeamentos</h5>
                        <a href="{{route('task_create')}}" class="btn btn-primary btn-xs pull-right">Criar nova Tarefa</a>
                    </div>
                    <div class="ibox-content">

                        @if($mapper->user->department)
                            <div class="project-list">
                                <form action="{{ route('mapping_tasks_store', ['id' => $mapper->id]) }}" method="post">

                                  <input type="hidden" name="user" value="{{ $mapper->user->id }}">
                                  <input type="hidden" name="mapper" value="{{ $mapper->id }}">
                                  {{ csrf_field() }}

                                  @if($tasks->isNotEmpty())
                                  <table class="table table-hover">
                                      <tbody>
                                        @forelse ($tasks as $task)
                                            @if($task->process->department->id == $mapper->user->department->id)
                                                <tr>
                                                  <td class="project-status">
                                                      <input type="checkbox" value="{{ $task->id }}" class="tasks" name="ids[]"/>
                                                  </td>
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
                                                  <td class="project-people">
                                                      <a href="{{route('user', ['id' => $task->sponsor->id])}}">
                                                      <img alt="image" class="img-circle" src="{{Gravatar::get($task->sponsor->email)}}"></a>
                                                  </td>
                                                  <td class="project-actions">
                                                      <a href="{{route('task', ['id' => $task->id])}}" class="btn btn-white btn-sm"> Visualizar </a>
                                                  </td>
                                              </tr>
                                          @endif

                                        @empty
                                        <tr>
                                            <td>Nenhuma tarefa até o momento.</td>
                                        </tr>
                                        @endforelse
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                            <td colspan="6">
                                              <button type="submit" id="btn-add-task-mapping" class="btn btn-xs">Adicionar ao Mapeamento</button>
                                            </td>
                                          </tr>
                                      </tfoot>
                                  </table>
                                  @else
                                      <div class="alert alert-warning">
                                          Nenhuma tarefa registrada até o momento.
                                      </div>
                                  @endif
                              </form>
                            </div>
                        @else
                            <div class="alert alert-info"> {{$mapper->user->name}} não está registrado(a) em nenhum Departamento, Adicione este usuário à um departamento. <a class="btn btn-xs btn-info" href="{{route('user', ['id' => $mapper->user->id])}}">editar</a></div>
                        @endif
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection

@push('scripts')
    <script>

        function allowAdd() {

            var input = $(".tasks");

            if(input.is(':checked')) {
              $('#btn-add-task-mapping').prop('disabled', false);
              $('#btn-add-task-mapping').addClass('btn-primary');
            } else {
              $('#btn-add-task-mapping').prop('disabled', true);
              $('#btn-add-task-mapping').removeClass('btn-primary');
            }
        }

        $(document).ready(function() {
            allowAdd();

            $(".tasks").click(function() {
                allowAdd();
            });
        })
    </script>
@endpush
