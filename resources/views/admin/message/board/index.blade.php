@extends('layouts.app')

@section('page-title', 'Mural de Recados')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.mural')
          <a href="{{route('message-board.create')}}" class="btn btn-custom m-t-lg">Novo Recado</a>
        @endpermission

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Caixa de Entrada</h6>

        @if($messages->isNotEmpty())

        <table class="table table-hover">

            <thead>
                <tr>
                  <th>Assunto</th>
                  <th>Enviado Por</th>
                  <th>Data</th>
                </tr>
            </thead>

            <tbody>

                @foreach($messages as $message)

                  <tr>
                      <td class="mail-subject"><a href="{{ route('message-board.show', $message->uuid) }}">{{ $message->subject }}</a>
                        @if($message->attachments)
                          <i class="fa fa-paperclip"></i>
                        @endif
                      </td>
                      <td class="mail-ontact"><img src="{{ route('image', ['user' => $message->user->uuid, 'link' =>  $message->user->avatar, 'avatar' => true])}}" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm">
                        <a href="{{ route('message-board.show', $message->uuid) }}">{{ $message->user->person->name ?? '' }}</a>
                      </td>
                      <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                  </tr>

                @endforeach

            </tbody>
        </table>

        @else

          <div class="widget white-bg no-padding">
              <div class="text-center">
                  <h1 class="m-md"><i class="far fa-bell-slash fa-3x"></i></h1>
                  <h3 class="font-bold no-margins">
                      Nenhum recado recebido até o momento.
                  </h3>
              </div>
          </div>

        @endif

    </div>

@endsection
