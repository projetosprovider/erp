@extends('layouts.layout')

@section('content')

      <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-10">
              <h2>Documentos</h2>
              <ol class="breadcrumb">
                  <li>
                      <a href="{{ route('home') }}">Painel Principal</a>
                  </li>
                  <li class="active">
                      <strong>Documentos</strong>
                  </li>
              </ol>
          </div>

          <div class="col-lg-2">
            @permission('create.documentos')
              <a href="{{route('documents.create')}}" class="btn btn-primary btn-block dim m-t-lg">Novo Documento</a>
            @endpermission
          </div>

      </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Documentos</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                            @if($documents->isNotEmpty())
                            <table class="table table-hover table-responsive">

                                <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Descrição</th>
                                      <th>Cliente</th>
                                      <th>Status</th>
                                      <th>Adicionado por</th>
                                      <th>Adicionado em</th>
                                      <th>Tempo passado</th>
                                      <th>Opções</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($documents as $document)
                                <tr>
                                    <td class="project-title">
                                        <a>{{$document->id}}</a>
                                    </td>

                                    <td class="project-title">
                                        <a>{{ $document->description }}</a>
                                    </td>

                                    <td class="project-title">
                                        <p><a href="{{route('clients.edit', ['id' => $document->client->uuid])}}">{{ $document->client->name }}</a></p>
                                    </td>

                                    <td class="project-title">
                                        <a>{{ $document->status->name }}</a>
                                    </td>

                                    <td class="project-title">
                                        <p><a>{{ $document->creator->person->name }}</a></p>
                                    </td>

                                    <td class="project-title">
                                        <p><a>{{ $document->created_at->format('d/m/Y H:i') }}</a></p>
                                    </td>

                                    <td class="project-title">
                                        <p><a>{{ $document->created_at->diffForHumans() }}</a></p>
                                    </td>

                                    <td class="project-actions">
                                      @permission('edit.documentos')
                                        @if($document->status_id == 1)
                                            <a href="{{route('delivery_order_conference', ['document[]' => $document->uuid])}}" class="btn btn-info btn-sm"><i class="fa fa-truck"></i> Gerar Ordem Entrega</a>
                                        @else
                                            <a href="{{route('documents.edit', ['id' => $document->uuid])}}" class="btn btn-info btn-outline btn-sm"><i class="fa fa-map-marker"></i> Rastreio Documento</a>
                                        @endif
                                      @endpermission

                                      @permission('edit.documentos')
                                        <a href="{{route('documents.edit', ['id' => $document->uuid])}}" class="btn btn-white  btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                                      @endpermission
                                      @permission('delete.documentos')
                                        <a data-route="{{route('documents.destroy', ['id' => $document->uuid])}}" class="btn btn-danger btn-outline  btn-sm btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                      @endpermission
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="text-center">{{ $documents->links() }}</div>

                            @else
                                <div class="alert alert-warning">Nenhuma ordem de entrega foi registrada até o momento.</div>
                            @endif
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection
