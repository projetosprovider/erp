@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Regras de Acesso </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Regras de Acesso</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            <a href="{{route('roles.create')}}" class="btn btn-primary btn-block dim m-t-lg">Nova Permissão</a>
        </div>

    </div>


    <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Regras de Acesso</h5>
                        <div class="ibox-tools">

                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">

                            @if($permissions->isNotEmpty())
                            <table class="table table-hover">
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td class="project-title">
                                        <p>Nome:</p>
                                        <a href="#">{{$permission->name}}</a>
                                    </td>
                                    <td class="project-title">
                                        <p>Descrição:</p>
                                        <a href="#">{{$permission->description}}</a>
                                    </td>
                                    <td class="project-actions">
                                        <a href="{{route('permissions.edit', ['id' => $permission->id])}}" class="btn btn-white"><i class="fa fa-pencil"></i> Editar</a>
                                        <a data-route="{{route('permissions.destroy', ['id' => $permission->id])}}" class="btn btn-danger btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">Nenhum sub-processo registrado até o momento.</div>
                            @endif
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection
