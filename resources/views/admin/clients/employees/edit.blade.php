@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>{{ $company->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('clients.show', $company->uuid) }}">{{ $company->name }}</a>
                </li>
                <li class="active">
                    <strong>Editar Funcionário</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Funcionário</h5>
                    </div>
                    <div class="ibox-content">

                      <form method="post" class="form-horizontal" action="{{route('client_employee_update', [$company->uuid, $employee->uuid])}}">

                          {{csrf_field()}}
                          {{method_field('PUT')}}

                          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $employee->name }}" name="name" class="form-control" autofocus required/>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif

                            </div>
                          </div>

                          <div class="form-group {{ $errors->has('cpf') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">CPF</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $employee->cpf }}" name="cpf" class="form-control inputCpf" required/>

                              @if ($errors->has('cpf'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('cpf') }}</strong>
                                  </span>
                              @endif

                            </div>
                          </div>

                          <div class="form-group {!! $errors->has('company_id') ? 'has-error' : '' !!}">
                              <label class="col-sm-2 control-label">Empresa</label>
                              <div class="col-sm-10">
                                <select class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="company_id" required>
                                      @foreach($companies as $companyItem)
                                          <option value="{{$companyItem->uuid}}" {{ $company->uuid == $companyItem->uuid ? 'selected' : '' }}>{{$companyItem->name}}</option>
                                      @endforeach
                                </select>
                                {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                              </div>
                          </div>

                          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $employee->email }}" name="email" class="form-control"/>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif

                            </div>
                          </div>

                          <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Telefone</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $employee->phone }}" name="phone" class="form-control inputPhone"/>

                              @if ($errors->has('phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                  </span>
                              @endif

                            </div>
                          </div>

                          <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                              <label class="col-sm-2 control-label">Ativo</label>
                              <div class="col-sm-10">
                                <input type="checkbox" name="active" class="js-switch" value="1" {{ $employee->active ? 'checked' : '' }}/>
                                  {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                              </div>
                          </div>

                          <button class="btn btn-primary">Salvar</button>
                          <a class="btn btn-white" href="{{ route('clients.show', $company->uuid) }}">Cancelar</a>
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
