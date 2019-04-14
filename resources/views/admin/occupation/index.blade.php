@extends('layouts.app')

@section('page-title', 'Cargos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.cargos')
          <a href="{{route('occupations.create')}}" class="btn btn-custom m-t-lg">Novo Cargo</a>
        @endpermission

    </div>

    <div class="row">

      @forelse($occupations as $occupation)

          <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card-box">
                  <h6 class="text-muted font-13 m-t-0 text-uppercase"><i class="fa fa-user"></i> {{$occupation->department->name}}</h6>
                  <h3 class="m-b-20 mt-3">{{$occupation->name}}</h3>

                  <div class="row text-center m-t-30">
                    <div class="col-6">
                        <a class="btn btn-default btn-block" href="{{route('occupations.edit', ['id' => $occupation->uuid])}}"><i class="fa fa-pencil"></i> Editar</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-danger btn-block btn-outline btnRemoveItem" data-route="{{route('occupations.destroy', ['id' => $occupation->uuid])}}"><i class="fa fa-close"></i> Remover</a>
                    </div>
                </div>
              </div>
          </div>

      @endforeach

    </div>

@endsection
