@extends('layouts.app')

@section('page-title', 'Mural de Recados')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

    @permission('create.mural')
      <a href="{{route('message-board.create')}}" class="btn btn-custom m-t-lg">Novo Recado</a>
    @endpermission

    @permission('create.mural')
      <a href="{{route('message-board.index')}}" class="btn btn-default">Voltar</a>
    @endpermission

</div>

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Informações</h6>

    <div class="m-t-30">
        <p>Assunto: <b>{{ $messageBoard->subject }}</b></p>
        <p class="text-muted">De: {{ $messageBoard->user->email }} </p>
        <p class="text-muted">Em: {{ $messageBoard->created_at->format('d/m/Y H:i:s') }} - {{ $messageBoard->created_at->diffForHumans() }}</p>
    </div>

</div>

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Mensagem</h6>
    {!! $messageBoard->content !!}
</div>

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Anexos</h6>
    @forelse($messageBoard->attachments as $file)
      <div class="file-box">
          <div class="file">
              <a target="_blank" href="{{ route('image', ['link'=>$file->link]) }}">
                  <span class="corner"></span>

                  <div class="icon">
                    @if(in_array($file->extension, ['jpeg','jpg']))
                        <img alt="image" class="img-fluid" src="{{ route('image', ['link'=>$file->link]) }}">
                    @else
                        <i class="fa fa-file"></i>
                    @endif
                  </div>
                  <div class="file-name">
                      {{ $file->filename }}
                      <br>
                      <small>{{ $file->created_at->format('M d, Y H:i') }}</small>
                  </div>
              </a>
          </div>
      </div>
    @empty

    <div class="widget white-bg no-padding">
        <div class="text-center">
            <h1 class="m-md"><i class="ti-clip"></i></h1>
            <h4 class="font-bold no-margins">
                Nenhum anexo encontrado.
            </h4>
        </div>
    </div>

    @endforelse
</div>

@endsection
