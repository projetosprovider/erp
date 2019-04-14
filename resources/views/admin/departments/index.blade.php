@extends('layouts.app')

@section('page-title', 'Departamentos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.departamentos')
          <a href="{{route('department_create')}}" class="btn btn-custom  dim m-t-lg">Novo Departamento</a>
        @endpermission

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        <div class="row">

          @foreach($departments as $department)

              <div class="col-sm-4">
                  <div class="card-box">
                      <h6 class="text-muted font-13 m-t-0 text-uppercase"><i class="fa fa-user"></i> {{$department->user->person->name}}</h6>
                      <h3 class="m-b-20 mt-3">{{$department->name}}</h3>

                      <div class="row text-center m-t-30">
                        <div class="col-4">
                            <a class="btn btn-default btn-block text-success" href="{{ route('occupations.index', ['department' => $department->uuid]) }}"><i class="fa fa-tag"></i> ({{ $department->occupations->count() }}) Cargos</a>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-default btn-block" href="{{ route('department_edit', $department->uuid) }}"><i class="fa fa-pencil"></i> Editar</a>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-default btn-block text-danger" href="{{route('department', ['id' => $department->uuid])}}"><i class="fa fa-cogs"></i> Processos</a>
                        </div>
                    </div>
                  </div>
              </div>

          @endforeach

        </div>

    </div>

@endsection
