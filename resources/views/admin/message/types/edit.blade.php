@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Tipos de Recado</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('message-types.index') }}">Tipos de Recado</a>
                </li>
                <li class="active">
                    <strong>Editar Tipo de Recado</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Tipo de Recado</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('message-types.update', $type->uuid)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10"><input type="text" name="name" class="form-control" value="{{ $type->name }}" autofocus required/></div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('message-types.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
