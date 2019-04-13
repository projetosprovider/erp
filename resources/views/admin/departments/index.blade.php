@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">

        <div class="col-lg-10">
            <h2>Departamentos </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Departamentos</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">

          @permission('create.departamentos')

            <a href="{{route('department_create')}}" class="btn btn-primary btn-block dim m-t-lg">Novo Departamento</a>

          @endpermission

        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            @foreach($departments as $department)

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <div class="widget style1 white-bg">

                    <div class="row">

                      <div class="col-xs-12">

                        <h2>
                            {{$department->name}}
                        </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-user m-r-xs"></span>
                                <label>Responsável:</label>
                                {{$department->user->person->name}}
                            </li>
                        </ul>

                      </div>

                      <div class="col-xs-12">

                        <div class="row">

                          <div class="col-md-4 col-sm-6 col-xs-12 p-xxs">
                              <a class="btn btn-primary btn-block" href="{{ route('occupations.index', ['department' => $department->uuid]) }}"><i class="fa fa-tag"></i> ({{ $department->occupations->count() }}) Cargos</a>
                          </div>

                          <div class="col-md-4 col-sm-6 col-xs-12 p-xxs">
                              <a class="btn btn-success btn-block" href="{{ route('department_edit', $department->uuid) }}"><i class="fa fa-pencil"></i> Editar</a>
                          </div>

                          <div class="col-md-4 col-sm-6 col-xs-12 p-xxs">
                              <a class="btn btn-danger btn-block btn-outline" href="{{route('department', ['id' => $department->uuid])}}"><i class="fa fa-cogs"></i> Processos</a>
                          </div>

                        </div>

                      </div>

                  </div>
                  </div>
                </div>

            @endforeach
        </div>
    </div>

@endsection
