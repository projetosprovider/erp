@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Board <a data-toggle="modal" data-target="#add-user-modal" class="btn bottom-right btn-primary pull-right">Novo</a></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Board</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

      <div class="row">
          @foreach($users as $user)

          @if($user->do_task && $user->active)

          <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <span class="label label-danger pull-right">{!! App\Http\Controllers\UsersController::getLatestTask($user->id) !!}</span>
                      <h5>{{ substr($user->name, 0, 15) }}</h5>
                  </div>
                  <div class="ibox-content" style="height: 100%;min-height: 500px;max-height: 500px;overflow-y: auto;">
                      <div class="team-members text-center">
                          <a href="{{ route('user', ['id' => $user->id]) }}"><img alt="member" class="img-circle" src="{{Gravatar::get($user->email)}}"></a>
                      </div>
                      <div class="col-lg-12 text-center">
                        <h2>{!! App\Http\Controllers\UsersController::getTaskPercentage($user->id) !!}%</h2>
                        <div class="progress progress-mini">
                            <div style="width: {!! App\Http\Controllers\UsersController::getTaskPercentage($user->id) !!}%;" class="progress-bar {!! App\Http\Controllers\UsersController::getTaskPercentageProgress($user->id) !!}"></div>
                        </div>

                        <hr/>

                        <a href="{{ route('tasks', ['user' => $user->id]) }}" class="btn btn-xs btn-block btn-white">Tarefas</a>

                        <hr/>

                      </div>



                      @forelse($user->tasks->sortBy('status_id') as $task)

                        @if($task->is_model)
                          @continue
                        @endif

                        @if($task->status_id == 4)
                          @continue
                        @endif

                            <span><a href="{{ route('task', ['id' => $task->id]) }}" class="text-navy">{{ substr($task->name, 0, 26) }}</a>:<br/>
                                <small>{{ $task->owner->name }}</small>
                            </span>
                            <div class="stat-percent">@if ($task->status_id == 1) 0%
                            @elseif ($task->status_id == 2) 50%
                            @elseif ($task->status_id == 3 || $task->status_id == 4) 100%
                            @endif</div>

                          <div class="progress progress-striped active progress-mini">
                            <div style="width:
                            @if ($task->status_id == 1) 0%
                            @elseif ($task->status_id == 2) 50%
                            @elseif ($task->status_id == 3 || $task->status_id == 4) 100%
                            @endif;" class="progress-bar
                            @if ($task->status_id == 2) progress-bar-warning
                            @elseif ($task->status_id == 4) progress-bar-danger
                            @endif;"></div>
                          </div>

                      @empty
                          <small>Nenhuma tarefa registrada</small>
                      @endforelse

                      <hr/>

                      @if($user->logs->isNotEmpty())
                      <div class="feed-activity-list text-center">

                        <hr/>

                        <h3>Histórico</h3>

                          <div>

                              @forelse(App\Http\Controllers\UsersController::getTodayLogs($user->id) as $log)
                              <div class="feed-element">
                                  <a href="{{ route('user', ['id' => $log->user->id]) }}" class="pull-left">
                                      <img alt="image" class="img-circle" src="{{Gravatar::get($log->user->email)}}">
                                  </a>
                                  <div class="media-body ">
                                      <small class="pull-right"></small>
                                      <strong>{{$log->user->name == Auth::user()->name ? 'Você' : $log->user->name}}</strong> {{ $log->message }} <br>
                                      <small class="text-muted">{{ $log->created_at->format('H:i - d.m.Y') }}</small>

                                  </div>
                              </div>
                              @empty
                              <div class="text-center">
                                  <p>Nenhum registro encontrado.</p>
                              </div>
                              @endforelse

                          </div>

                      </div>
                      @endif


                      <!--
                      <div class="row  m-t-sm">
                          <div class="col-sm-4">
                              <div class="font-bold">PROJECTS</div>
                              12
                          </div>
                          <div class="col-sm-4">
                              <div class="font-bold">RANKING</div>
                              4th
                          </div>
                          <div class="col-sm-4 text-right">
                              <div class="font-bold">BUDGET</div>
                              $200,913 <i class="fa fa-level-up text-navy"></i>
                          </div>
                      </div>
                    -->

                  </div>
              </div>
          </div>

          @endif

          @endforeach
    </div>


@endsection
