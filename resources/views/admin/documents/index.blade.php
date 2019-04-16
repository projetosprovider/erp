@extends('layouts.app')

@section('page-title', 'Documentos')

@section('content')

      <div class="card-box">
          <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

          @permission('create.documentos')
            <a href="{{route('documents.create')}}" class="btn btn-custom m-t-lg">Novo Documento</a>
          @endpermission

      </div>

      <div class="card-box">
          <h6 class="font-13 m-t-0 m-b-30">listagem</h6>

          <div class="table-responsive">
              @if($documents->isNotEmpty())
              <table class="table table-hover">

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

                  <div class="widget white-bg no-padding">
                      <div class="p-m text-center">
                          <h1 class="m-md"><i class="far fa-folder-open fa-3x"></i></h1>
                          <h4 class="font-bold no-margins">
                              Nenhum documento encontrado.
                          </h4>
                      </div>
                  </div>

              @endif
          </div>

      </div>

@endsection
