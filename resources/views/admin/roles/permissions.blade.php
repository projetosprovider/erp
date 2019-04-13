@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Regras de Acesso </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">Regras de Acesso</a>
                </li>
                <li class="active">
                    <strong>Permissões</strong>
                </li>
            </ol>
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

                                @php
                                    $hasPermission = $role->detachPermission($permission);
                                @endphp

                                <tr>
                                    <td class="project-title">
                                        <p>#:</p>
                                        <a href="#">{{$hasPermission ? 'SIM' : 'NÃO'}}</a>
                                    </td>
                                    <td class="project-title">
                                        <p>Nome:</p>
                                        <a href="#">{{$permission->name}}</a>
                                    </td>
                                    <td class="project-title">
                                        <p>Descrição:</p>
                                        <a href="#">{{$permission->description}}</a>
                                    </td>
                                    <td class="project-actions">
                                      @if($hasPermission)
                                        <a data-route="{{route('permissions.destroy', ['id' => $permission->id])}}" class="btn btn-danger btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                      @else
                                        <a data-route="{{route('permissions.destroy', ['id' => $permission->id])}}" class="btn btn-primary"><i class="fa fa-check"></i> Conceder Permissão</a>
                                      @endif
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
