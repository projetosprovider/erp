@extends('layouts.app')

@section('page-title', 'Clientes')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.clientes')
            <a href="{{route('clients.create')}}" class="btn btn-custom"><i class="fas fa-user-plus"></i> Novo Cliente</a>
        @endpermission

    </div>

    <div class="card-box">
      <h6 class="font-13 m-t-0 m-b-30">Pesquisa</h6>

      <form method="get" action="?">
        <div class="row">
            <div class="col-md-5"><input name="search" type="text" placeholder="ID, Nome, Documento, Email, ou Telefone" class="form-control"></div>
            <div class="col-md-2">
              <select class="select2" data-live-search="true" title="Situação" data-style="btn-white" data-width="100%" placeholder="Situação" name="status">
                  <option value="">Situação</option>
                  <option value="1">Ativo</option>
                  <option value="0">Inativo</option>
              </select>
            </div>
            <div class="col-md-3"><input name="address" type="text" placeholder="CEP, Endereço" class="form-control"></div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i>  Buscar</button></div>

        </div>
      </form>

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Listagem (<small class="text-navy">Registros retornados: {{ $quantity }}</small>)</h6>

        @if($clients->isNotEmpty())
            <table class="table table-hover">
                <thead>

                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                  </tr>

                </thead>

                <tbody>
                    @foreach($clients as $client)
                        <tr>

                            <td class="project-title">
                                <a>{{$client->id}}</a>
                            </td>

                            <td class="project-title">
                                <a href="{{route('clients.show', ['id' => $client->uuid])}}">{{$client->name}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$client->document}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$client->phone}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$client->email}}</a>
                            </td>

                            <td class="project-title">
                              @if($client->active)
                                <span class="badge badge-custom">Ativo</span>
                              @else
                                <span class="badge badge-danger">Inativo</span>
                              @endif
                            </td>

                            <td class="project-actions">

                              @permission('view.clientes')
                                <a href="{{route('clients.show', ['id' => $client->uuid])}}" class="btn btn-default text-success"><i class="fa fa-info"></i> </a>
                              @endpermission

                              @permission('edit.clientes')
                                <a href="{{route('clients.edit', ['id' => $client->uuid])}}" class="btn btn-default"><i class="far fa-edit"></i> </a>
                              @endpermission

                              @permission('delete.clientes')
                                <a data-route="{{route('clients.destroy', ['id' => $client->uuid])}}" class="btn btn-default text-danger btnRemoveItem"><i class="fas fa-user-times"></i> </a>
                              @endpermission
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
            {{ $clients->links() }}
            </div>

        @else

            <div class="widget white-bg no-padding">
                <div class="p-m text-center">
                    <h1 class="m-md"><i class="far fa-folder-open fa-3x"></i></h1>
                    <h4 class="font-bold no-margins">
                        Nenhum registro encontrado para o parametros informados.
                    </h4>
                </div>
            </div>

        @endif

    </div>

@endsection
