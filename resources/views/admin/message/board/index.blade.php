@extends('layouts.layout')

@section('content')

      <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
              <h2>Mural de Recados</h2>
              <ol class="breadcrumb">
                  <li>
                      <a href="{{ route('home') }}">Painel Principal</a>
                  </li>
                  <li class="active">
                      <strong>Mural de Recados</strong>
                  </li>
              </ol>
          </div>

          <div class="col-lg-2">
            @permission('create.mural')
              <a href="{{route('message-board.create')}}" class="btn btn-primary btn-block dim m-t-lg">Novo Recado</a>
            @endpermission
          </div>

      </div>

      <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="{{route('message-board.create')}}">Novo</a>
                            <div class="space-25"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="{{route('message-board.index')}}"> <i class="fa fa-inbox "></i> Entrada @if($messagesWaiting->count())<span class="label label-warning float-right">{{ $messagesWaiting->count() }}</span>@endif </a></li>
                                <li><a href="#"> <i class="fa fa-envelope-o"></i> Enviados</a></li>
                                <li><a href="#"> <i class="fa fa-certificate"></i> Importantes</a></li>
                                <li><a href="#"> <i class="fa fa-trash-o"></i> Lixeira</a></li>
                            </ul>
                            <h5>Categories</h5>
                            <ul class="category-list" style="padding: 0">
                              @foreach($categories as $category)
                                  <li><a href="?category={{$category->name}}"> <i class="fa fa-circle text-{{ array_random(['navy','danger','primary','info','warning']) }}"></i> {{ $category->name }} </a></li>
                              @endforeach
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">


                <h2>
                    Entrada
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group float-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-mail">
                <tbody>

                @forelse($messages as $message)

                  <tr class="{{ $message->status == 'PENDENTE' ? 'unread' : 'read' }}">
                      <td class="check-mail">
                          <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                      </td>
                      <td class="mail-ontact"><a href="{{ route('message-board.show', $message->uuid) }}">{{ $message->user->person->name ?? '' }}</a></td>
                      <td class="mail-subject"><a href="{{ route('message-board.show', $message->uuid) }}">{{ $message->subject }}</a></td>
                      <td class="">
                        @if($message->attachments)
                          <i class="fa fa-paperclip"></i>
                        @endif
                      </td>
                      <td class="text-right mail-date">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                  </tr>

                @empty
                  <tr><td>
                  <div class="widget white-bg no-padding">
                      <div class="text-center">
                          <h1 class="m-md"><i class="far fa-envelope-open fa-4x"></i></h1>
                          <h3 class="font-bold no-margins">
                              Nenhum recado recebido até o momento.
                          </h3>
                      </div>
                  </div>
                </td></tr>
                @endforelse

                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>

@endsection
