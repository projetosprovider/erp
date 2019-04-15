@extends('layouts.app')

@section('page-title', 'Documentos')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Novo Documento</h6>

    <form method="post" action="{{route('documents.store')}}">
        {{csrf_field()}}

        <div class="row m-b-30">

            <div class="col-md-4">

                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    <label class="col-form-label">Descrição</label>
                    <div class="input-group">
                      <input type="text" required name="description" value="{{ old('description') }}" class="form-control">
                    </div>
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {!! $errors->has('type_id') ? 'has-error' : '' !!}">
                    <label class="col-form-label">Tipo</label>
                    <div class="input-group">
                      <select class="select2" title="Selecione" name="type_id" required>
                          @foreach($types as $type)
                              <option value="{{$type->uuid}}">{{$type->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
                </div>

            </div>

            <div class="col-md-4">

              <div class="form-group {!! $errors->has('client_id') ? 'has-error' : '' !!}">
                  <label class="col-form-label">Cliente</label>
                  <div class="input-group">
                    <select class="select2 select-client-addresses select-client-employees" data-search-addresses="{{ route('client_addresses_search') }}"
                      data-search-employees="{{ route('client_employees_search') }}"
                      name="client_id" required>
                          <option value="">Selecione um Cliente</option>
                          @foreach($clients as $client)
                              <option value="{{$client->uuid}}">{{$client->name}}</option>
                          @endforeach
                    </select>
                  </div>
                  {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}
              </div>

              <div class="form-group {!! $errors->has('address_id') ? 'has-error' : '' !!}">
                  <label class="col-form-label">Endereço</label>
                  <div class="input-group">
                    <select class="select2" id="select-address" name="address_id" required>
                        <option value="">Selecione um Cliente</option>
                    </select>
                  </div>
                  {!! $errors->first('address_id', '<p class="help-block">:message</p>') !!}
              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group {!! $errors->has('employee_id') ? 'has-error' : '' !!}">
                  <label class="col-form-label">Funcionário</label>
                  <div class="input-group">
                    <select class="select2 select-client-employees" data-search-employees="{{ route('client_employees_search') }}" id="select-employee" name="employee_id" required>
                          <option value="">Selecione um Cliente</option>

                    </select>
                  </div>
                  {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
              </div>

            </div>

        </div>

        <button class="btn btn-custom">Salvar</button>
        <a class="btn btn-default" href="{{ route('documents.index') }}">Cancelar</a>


    </form>

</div>

@endsection
