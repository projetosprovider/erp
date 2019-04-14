@extends('layouts.app')

@section('page-title', 'Clientes')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

    @permission('create.clientes')
        <a href="{{route('client_employee_create', $client->uuid)}}" class="btn btn-default text-success m-t-lg"><i class="fas fa-user-plus"></i> Novo Funcionário</a>
    @endpermission

    @permission('create.clientes')
        <a href="{{route('client_addresses_create', $client->uuid)}}" class="btn btn-default dim m-t-lg"><i class="fas fa-map-marked-alt"></i> Novo Endereço</a>
    @endpermission

</div>

<div class="card-box">
  <div class="row widget style1">
      <div class="col-lg-12">
          <div class="m-b-md">
              <a href="{{route('clients.edit', ['id' => $client->uuid])}}"
                 style="margin-left: 4px;"
                 class="btn btn-default btn-outline pull-right"><i class="far fa-edit"></i> Editar</a>
              <h2>{{ $client->name}} </h2>
              <p>

                @if($client->active)
                    <i class="fa fa-circle text-custom"></i> Ativo
                @else
                    <i class="fa fa-circle text-danger"></i> Inativo
                @endif

              </p>
              <p>CPF/CNPJ: {{ $client->document }}</p>
              <p>Email: {{ $client->email }}</p>
              <p>Telefone: {{ $client->phone }}</p>
          </div>
      </div>
  </div>

</div>

<div class="card-box">

    <ul class="nav nav-tabs tabs-bordered">
        <li class="nav-item">
            <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active show">
                Funcionários
            </a>
        </li>
        <li class="nav-item">
            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                Endereços
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active show" id="home-b1">

          @if($client->employees->isNotEmpty())
              <table class="table table-hover">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Ativo</th>
                        <th>Opções</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($client->employees as $employee)
                          <tr>

                              <td class="project-title">
                                  <a>{{$employee->id}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$employee->name}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$employee->email}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$employee->cpf}}</a>
                              </td>

                              <td class="project-title">
                                @if($employee->active)
                                  <span class="badge badge-custom">Ativo</span>
                                @else
                                  <span class="badge badge-danger">Inativo</span>
                                @endif
                              </td>

                              <td class="project-actions">
                                @permission('edit.clientes')
                                  <a href="{{route('client_employee_edit', [$client->uuid, $employee->uuid])}}" class="btn btn-default"><i class="far fa-edit"></i> </a>
                                @endpermission

                                @permission('delete.clientes')
                                  <a data-route="{{route('client_employee_destroy', ['id' => $employee->uuid])}}" class="btn btn-danger btnRemoveItem"><i class="fas fa-trash-alt"></i> </a>
                                @endpermission
                              </td>

                          </tr>
                      @endforeach
                  </tbody>
              </table>

          @else
            <div class="widget white-bg no-padding">
                <div class="p-m text-center">
                    <h1 class="m-md"><i class="far fa-folder-open fa-4x"></i></h1>
                    <h3 class="font-bold no-margins">
                        Nenhum registro encontrado.
                    </h3>

                    @permission('create.clientes')
                        <a href="{{route('client_employee_create', $client->uuid)}}" class="btn btn-default text-success p-m"><i class="fas fa-user-plus"></i> Novo Funcionário</a>
                    @endpermission
                </div>
            </div>
          @endif

        </div>
        <div class="tab-pane" id="profile-b1">

          @if($client->addresses->isNotEmpty())
              <table class="table table-hover">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Endereço</th>
                        <th>Principal</th>
                        <th>Opções</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($client->addresses as $address)
                          <tr>

                              <td class="project-title">
                                  <a>{{$address->id}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$address->description}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$address->street}}, {{$address->number}} - {{$address->district}}, {{$address->city}} - {{$address->zip}}</a>
                              </td>

                              <td class="project-title">
                                  <a>{{$address->is_default ? 'SIM' : 'NÃO' }}</a>
                              </td>

                              <td class="project-actions">
                                @permission('edit.clientes')
                                  <a href="{{route('client_addresses_edit', [$client->uuid, $address->uuid])}}" class="btn btn-default"><i class="far fa-edit"></i> </a>
                                @endpermission

                                @permission('delete.clientes')
                                  <a data-route="{{route('client_address_destroy', ['id' => $address->uuid])}}" class="btn btn-danger btnRemoveItem"><i class="fas fa-trash-alt"></i> </a>
                                @endpermission
                              </td>

                          </tr>
                      @endforeach
                  </tbody>
              </table>

          @else
            <div class="widget white-bg no-padding">
                <div class="p-m text-center">
                    <h1 class="m-md"><i class="far fa-folder-open fa-4x"></i></h1>
                    <h3 class="font-bold no-margins">
                        Nenhum registro encontrado.
                    </h3>

                    @permission('create.clientes')
                        <a href="{{route('client_addresses_create', $client->uuid)}}" class="btn btn-default dim m-t-lg"><i class="fas fa-map-marked-alt"></i> Novo Endereço</a>
                    @endpermission
                </div>
            </div>
          @endif

        </div>
    </div>
</div>

@endsection

@section('js')

@endsection
