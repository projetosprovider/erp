@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Clientes</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('clients.index')}}">Clientes</a>
                </li>
                <li class="active">
                    <strong>Editar Cliente</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Cliente</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('clients.update', $client->uuid)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" required placeholder="Este campo é opcional" name="name" value="{{ $client->name }}" class="form-control"/>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('document') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">CPF/CNPJ</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Informe o CPF ou CNPJ" id="cpf" name="document" value="{{ $client->document }}" class="form-control"/>
                                    {!! $errors->first('document', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                  <input type="text" required name="email" value="{{ $client->email }}" class="form-control"/>
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                                <label class="col-sm-2 control-label">Telefone</label>
                                <div class="col-sm-10">
                                  <input type="text" required name="phone" value="{{ $client->phone }}" class="form-control inputPhone"/>
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                                <label class="col-sm-2 control-label">Ativo</label>
                                <div class="col-sm-10">
                                  <input type="checkbox" name="active" class="js-switch" value="{{ 1 }}" {{ $client->active ? 'checked' : '' }}/>
                                    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('clients.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
