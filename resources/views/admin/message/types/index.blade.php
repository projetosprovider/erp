@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-10">
            <h2>Tipos de Recados</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Tipos de Recados</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">

          @permission('create.cargos')

            <a href="{{route('message-types.create')}}" class="btn btn-primary btn-block dim m-t-lg">Novo Tipo de Recado</a>

          @endpermission

        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            @forelse($types as $type)

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 cardMessageTypes">
                  <div class="widget white-bg">

                    <div class="row">

                      <div class="col-xs-12">

                        <h2>
                            {{$type->name}}
                        </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-sign-in m-r-xs"></span>
                                <label>Adicionado Em:</label>
                                {{ $type->created_at->format('d/m/Y H:i') }}
                            </li>
                        </ul>

                      </div>

                      <div class="col-xs-12">

                        <div class="row">

                          <div class="col-sm-6 col-xs-12">
                              <a class="btn btn-success btn-block" href="{{route('message-types.edit', ['id' => $type->uuid])}}"><i class="fa fa-pencil"></i> Editar</a>
                          </div>

                          <div class="col-sm-6 col-xs-12">
                              <a class="btn btn-danger btn-block btn-outline btnRemoveItem" data-route="{{route('message-types.destroy', ['id' => $type->uuid])}}"><i class="fa fa-close"></i> Remover</a>
                          </div>

                        </div>

                      </div>

                  </div>
                  </div>
                </div>

            @empty

                <div class="widget white-bg p-lg text-center">
                    <div class="m-b-md">
                        <h3 class="font-bold">
                            <i class="fa fa-search"></i> Nada Encontrado...
                        </h3>
                    </div>
                </div>

            @endforelse

        </div>
    </div>


@endsection
