@extends('layouts.app')

@section('page-title', 'Notificações')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Timeline</h6>

        <div class="row">

          <div class="timeline">

              @if($today)

              <article class="timeline-item alt">
                  <div class="text-right">
                      <div class="time-show first">
                          <a href="#" class="btn btn-custom">Hoje</a>
                      </div>
                  </div>
              </article>

              @endif

              @foreach($today as $notification)

              <article class="timeline-item {{ $loop->iteration % 2 != 0 ? 'alt' : '' }}">
                  <div class="timeline-desk">
                      <div class="panel">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                              <h4 class="">{{ \App\Helpers\TimesAgo::render($notification->created_at) }}</h4>
                              <p class="timeline-date text-muted"><small>{{ $notification->created_at->format('H:i') }}</small></p>
                              <p>{{ $notification->data['message'] }} </p>
                          </div>
                      </div>
                  </div>
              </article>

              @endforeach

              @if($yesterday)

              <article class="timeline-item alt">
                  <div class="text-right">
                      <div class="time-show">
                          <a href="#" class="btn btn-custom">Ontem</a>
                      </div>
                  </div>
              </article>

              @endif

              @foreach($yesterday as $notification)

              <article class="timeline-item {{ $loop->iteration % 2 != 0 ? 'alt' : '' }}">
                  <div class="timeline-desk">
                      <div class="panel">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                              <h4 class="">{{ \App\Helpers\TimesAgo::render($notification->created_at) }}</h4>
                              <p class="timeline-date text-muted"><small>{{ $notification->created_at->format('H:i') }}</small></p>
                              <p>{{ $notification->data['message'] }} </p>
                          </div>
                      </div>
                  </div>
              </article>

              @endforeach

              @if($older)

              <article class="timeline-item alt">
                  <div class="text-right">
                      <div class="time-show">
                          <a href="#" class="btn btn-primary">Recentes</a>
                      </div>
                  </div>
              </article>

              @endif

              @foreach($older as $notification)

              <article class="timeline-item {{ $loop->iteration % 2 != 0 ? 'alt' : '' }}">
                  <div class="timeline-desk">
                      <div class="panel">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                              <h4 class="">{{ \App\Helpers\TimesAgo::render($notification->created_at) }}</h4>
                              <p class="timeline-date text-muted"><small>{{ $notification->created_at->format('H:i') }}</small></p>
                              <p>{{ $notification->data['message'] }} </p>
                          </div>
                      </div>
                  </div>
              </article>

              @endforeach

          </div>


        </div>

    </div>

@endsection
