@extends('layouts.app')

@section('page-title', $company->name . ": Funcionários")

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Novo Funcionário </h6>
    <form method="post" class="" action="{{route('client_employee_store', $company->uuid)}}">

        {{csrf_field()}}

        <div class="row m-b-30">

            <div class="col-md-4">
                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="name">Nome</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Informe o nome">

                    </div>
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>


                <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="email">Email</label>
                    <div class="input-group">
                        <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Informe o email">

                    </div>
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group {!! $errors->has('cpf') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="cpf">CPF</label>
                    <div class="input-group">
                        <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" class="form-control" placeholder="Informe o CPF">

                    </div>
                    {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="phone">Telefone</label>
                    <div class="input-group">
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Informe o Telefone">

                    </div>
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>

            </div>

            <div class="col-md-4">

                <div class="form-group {!! $errors->has('company_id') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="company_id">Empresa</label>
                    <div class="input-group">
                        <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="company_id" required>
                              @foreach($companies as $companyItem)
                                  <option value="{{$company->uuid}}" {{ $company->uuid == $companyItem->uuid || old('company_id') == $companyItem->uuid ? 'selected' : '' }}>{{$companyItem->name}}</option>
                              @endforeach
                        </select>
                    </div>
                    {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                    <label class="col-form-label" for="active">Ativo</label>
                    <div class="input-group">
                        <input type="checkbox" id="active" name="active" data-plugin="switchery" checked value="{{ 1 }}">

                    </div>
                    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                </div>


            </div>

        </div>

        <button class="btn btn-custom">Salvar</button>
        <a class="btn btn-default" href="{{ route('clients.show', $company->uuid) }}">Cancelar</a>
    </form>
</div>

@endsection
