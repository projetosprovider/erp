@extends('layouts.app')

@section('page-title', 'Painel Principal')

@section('content')


<div class="row">
    <div class="col-md-8">
        <div class="card-box">
            <h6 class="font-13 m-t-0 m-b-30">Mural de Recados</h6>

            @if($messages->isNotEmpty())

            <div class="timeline">

                @foreach($messages as $message)

                <article class="timeline-item {{ $loop->index % 2 == 0 ? 'alt' : '' }}">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow{{ $loop->index % 2 == 0 ? '-alt' : '' }}"></span>
                                <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                <h4 class="">{{ \App\Helpers\TimesAgo::render($message->created_at) }}</h4>
                                <p class="timeline-date text-muted"><small>{{ $message->created_at->format('H:i:s d/m/Y') }}</small></p>
                                <a class="" href="{{route('user')}}">
                                    <img width="45" class="img-circle rounded-circle" src="{{ route('image', ['user' => $message->user->uuid, 'link' => $message->user->avatar, 'avatar' => true])}}">
                                </a>
                                <strong>{{ $message->user->person->name }}</strong> adicionou um novo recado sobre: <a class="" href="{{ route('message-board.show', $message->uuid) }}">{{ $message->subject }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </article>

                @endforeach

            </div>

            @else

              <div class="widget white-bg no-padding">
                  <div class="p-m text-center">
                      <h1 class="m-md"><i class="far fa-bell-slash fa-2x"></i></h1>
                      <br/>
                      <h4 class="font-bold no-margins">
                          Voce não possui nenhum recado até o momento
                      </h4>
                  </div>
              </div>

            @endif

        </div>
    </div> <!-- end col -->

    <div class="col-md-4">
        <div class="card-box">
            <h6 class="font-13 m-t-0 m-b-30">Atividades recentes</h6>

            <div class="row">
                <div class="col-sm-12">

                    @if($activities->isNotEmpty())

                    <div class="timeline timeline-left">

                        @foreach($activities->take(4) as $activity)

                        <article class="timeline-item">
                            <div class="timeline-desk">
                                <div class="panel">
                                    <div class="timeline-box">
                                        <span class="arrow"></span>
                                        <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                        <h4 class="">{{ \App\Helpers\TimesAgo::render($activity->created_at) }}</h4>
                                        <p class="timeline-date text-muted"><small>{{ $activity->created_at->format('H:i') }}</small></p>
                                        <p>{{ $activity->description }}:
                                           {{ html_entity_decode(\App\Helpers\Helper::getTagHmtlForModel($activity->subject_type, $activity->subject_id)) }} </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        @endforeach

                    </div>

                    @else

                    <div class="widget white-bg no-padding">
                        <div class="p-m text-center">
                            <h1 class="m-md"><i class="fas fa-history fa-2x"></i></h1>
                            <br/>
                            <h4 class="font-bold no-margins">
                                Voce não possui nenhum log até o momento
                            </h4>
                        </div>
                    </div>

                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
