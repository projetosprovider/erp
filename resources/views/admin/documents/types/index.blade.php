@extends('layouts.app')

@section('page-title', 'Tipos de Documentos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.cargos')
          <a href="{{route('types.create')}}" class="btn btn-custom dim m-t-lg">Novo Tipo</a>
        @endpermission

    </div>

    <div class="row">

        @forelse($types as $type)

            <div class="col-sm-3">
                <div class="card-box">
                    <h6 class="text-muted font-13 m-t-0 text-uppercase"><i class="fa fa-money"></i> {{number_format($type->price, 2, ',', '')}}</h6>
                    <h3 class="m-b-20 mt-3">{{$type->name}}</h3>

                    <div class="row text-center m-t-30">
                      <div class="col-12">
                          <a class="btn btn-default" href="{{route('types.edit', ['id' => $type->uuid])}}"><i class="fa fa-pencil"></i> Editar</a>
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

@endsection
