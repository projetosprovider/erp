@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-10">
            <h2>Tipos de Documentos </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Tipos de Documentos</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">

          @permission('create.cargos')

            <a href="{{route('types.create')}}" class="btn btn-primary btn-block dim m-t-lg">Novo Tipo</a>

          @endpermission

        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            @forelse($types as $type)

                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                  <div class="widget navy-bg">

                    <div class="row">

                      <div class="col-xs-12">

                        <h2>
                            {{$type->name}}
                        </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-money m-r-xs"></span>
                                <label>Valor:</label>
                                {{number_format($type->price, 2, ',', '')}}

                            </li>

                        </ul>

                      </div>

                      <div class="col-xs-12">

                        <div class="row">

                          <div class="col-sm-12 col-xs-12">
                              <a class="btn btn-primary btn-block" href="{{route('types.edit', ['id' => $type->uuid])}}"><i class="fa fa-pencil"></i> Editar</a>
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
                        <br/>
                        <a class="btn btn-white btn-lg" href="{{ route('home') }}">Voltar</a>
                    </div>
                </div>

            @endforelse

        </div>
    </div>

@endsection
