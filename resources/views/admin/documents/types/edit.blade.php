@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Tipos de Documentos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('documents.index')}}">Tipos de Documentos</a>
                </li>
                <li class="active">
                    <strong>Editar Tipo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Tipo de Documento</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('types.update', $type->uuid)}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" required name="name" value="{{ $type->name }}" class="form-control"/>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Valor Cobrado (R$)</label>
                                <div class="col-sm-10">
                                  <input type="text" name="price" value="{{ number_format($type->price, 2, '.', ',') }}" class="form-control inputMoney"/>
                                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('types.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
