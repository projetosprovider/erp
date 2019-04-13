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
                              <li><a href="{{route('message-board.index')}}"> <i class="fa fa-inbox "></i> Entrada <span class="label label-warning float-right">16</span> </a></li>
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
                    Mensagem
                </h2>
                <div class="mail-tools m-t-md">
                    <h3>
                        <span class="font-normal">Assunto: </span>{{ $messageBoard->subject }}
                    </h3>
                    <h5>
                        <span class="float-right font-normal">{{ $messageBoard->created_at->format('d/m/Y H:i:s') }}</span>
                        <br/>
                        <span class="font-normal">De: </span>{{ $messageBoard->user->email }}
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    {!! $messageBoard->content !!}
                </div>
                    <div class="mail-attachment">
                        <p>
                            <span><i class="fa fa-paperclip"></i> {{ $messageBoard->attachments->count() }} anexos</span>
                        </p>

                        <div class="attachment">

                          @foreach($messageBoard->attachments as $file)
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
                          @endforeach

                            <div class="clearfix"></div>
                        </div>
                        </div>
                        <div class="mail-body text-right tooltip-demo">
                                <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                                <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</button>
                        </div>
                        <div class="clearfix"></div>


                </div>
            </div>

        </div>
        </div>

@endsection
