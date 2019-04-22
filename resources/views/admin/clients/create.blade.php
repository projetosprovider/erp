@extends('layouts.app')

@section('page-title', 'Clientes')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Novo Cliente </h6>

        <form method="post" class="" action="{{route('clients.store')}}">
            {{csrf_field()}}

            <div class="row m-b-30">

                <div class="col-md-4">
                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="name">Nome</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Informe o nome">

                        </div>
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="phone">Telefone</label>
                        <div class="input-group">
                            <input type="text" id="phone" name="phone" class="form-control inputPhone" placeholder="Informe o Telefone">

                        </div>
                        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group {!! $errors->has('document') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="document">CPF/CNPJ</label>
                        <div class="input-group">
                            <input type="text" id="document" name="document" value="{{ old('document') }}" class="form-control" placeholder="Informe o CPF ou CNPJ">

                        </div>
                        {!! $errors->first('document', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="active">Ativo</label>
                        <div class="input-group">
                            <input type="checkbox" id="active" name="active" data-plugin="switchery" checked value="{{ 1 }}">

                        </div>
                        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                        <label class="col-form-label" for="email">Email</label>
                        <div class="input-group">
                            <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Informe o email">

                        </div>
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

            </div>

            <button class="btn btn-custom">Salvar</button>
            <a class="btn btn-default" href="{{ route('clients.index') }}">Cancelar</a>
        </form>
    </div>

@endsection
