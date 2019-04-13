@extends('layouts.app')

@section('page-title', 'Painel Principal')

@section('content')


<div class="row">
    <div class="col-md-8">
        <div class="card-box">
            <h6 class="font-13 m-t-0 m-b-30">Mural de Recados</h6>

            <div class="feed-activity-list">
              @forelse($messages as $message)
                <div class="feed-element">

                    <div class="media-body">
                        <a class="" href="{{route('user')}}">
                            <img alt="" class="img-circle rounded-circle" src="{{ route('image', ['user' => $message->user->uuid, 'link' => $message->user->avatar, 'avatar' => true])}}">
                        </a>
                        <small class="float-right">{{ $message->created_at->diffforHumans() }}</small><br>
                        <strong>{{ $message->user->person->name }}</strong> adicionou um novo recado sobre: <a class="" href="{{ route('message-board.show', $message->uuid) }}">{{ $message->subject }}</a><br>
                        <small class="text-muted">{{ $message->created_at->format('H:i:s d/m/Y') }}</small>
                    </div>
                </div>

              @empty

                <div class="widget white-bg no-padding">
                    <div class="p-m text-center">
                        <h1 class="m-md"><i class="far fa-envelope-open fa-3x"></i></h1>
                        <h3 class="font-bold no-margins">
                            Nenhum recado recebido até o momento.
                        </h3>
                    </div>
                </div>

              @endforelse

            </div>

        </div>
    </div> <!-- end col -->

    <div class="col-md-4">
        <div class="card-box">
            <h6 class="font-13 m-t-0 m-b-30">Atividades recentes</h6>

            @forelse($activities as $activity)
            <div class="timeline-item">
                <div class="row">
                    <div class="col-xs-3 date">
                        <i class="fa fa-comments"></i>
                        {{ $activity->created_at->format('H:i') }}
                        <br>
                        <small class="text-navy">{{ \App\Helpers\TimesAgo::render($activity->created_at) }}</small>
                    </div>
                    <div class="col-xs-7 content no-top-border">
                        <p>{{ $activity->description }}:
                           {{ html_entity_decode(\App\Helpers\Helper::getTagHmtlForModel($activity->subject_type, $activity->subject_id)) }}</p>
                    </div>
                </div>
            </div>

            @empty
                <div class="alert alert-warning">
                    Voce não possui nenhum log até o momento>.
                </div>
            @endforelse


        </div>
    </div> <!-- end col -->
</div>

@endsection
