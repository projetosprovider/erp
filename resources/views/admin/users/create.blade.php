@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Usuários</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Novo Usuário</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Novo Usuário</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('users.store')}}">

                            {{csrf_field()}}

                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" value="{{ old('name') }}" required name="name" autofocus class="form-control">
                                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-10">
                                  <input type="text" autocomplete="off" value="{{ old('email') }}" required name="email" class="form-control">
                                  {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                                <label class="col-sm-2 control-label">Telefone</label>
                                <div class="col-sm-10">
                                  <input type="text" name="phone" value="{{ old('phone') }}" class="form-control inputPhone"/>
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('cpf') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-10">
                                  <input type="text" value="{{ old('cpf') }}" name="cpf" class="form-control inputCpf">
                                  {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('birthday') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-10">
                                  <input type="text" value="{{ old('birthday') }}" name="birthday" class="form-control inputDate">
                                  {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Senha Acesso</label>
                                <div class="col-sm-10">
                                  <input type="password" autocomplete="off" value="{{ old('password') }}" name="password" class="form-control">
                                  {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('roles') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Previlégio</label>
                                <div class="col-sm-10">
                                  <select id="roles" name="roles" required class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%">
                                    @foreach($roles as $role)
                                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                  </select>
                                  {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>
                              <div class="col-sm-10">
                              <select class="selectpicker show-tick select-occupations" name="department_id" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" data-search-occupations="{{ route('occupation_search') }}" required>
                                @foreach($departments as $department)
                                    <option value="{{$department->uuid}}">{{$department->name}}</option>
                                @endforeach
                              </select>
                              </div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">Cargo</label>
                              <div class="col-sm-10">
                              <select class="selectpicker show-tick occupation" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%"  id="occupation" name="occupation_id" required>
                                @foreach($occupations as $occupation)
                                    <option value="{{$occupation->uuid}}">{{$occupation->name}}</option>
                                @endforeach
                              </select>
                              </div>
                            </div>

                            <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                                <label class="col-sm-2 control-label">Ativo</label>
                                <div class="col-sm-10">
                                  <input type="checkbox" name="active" class="js-switch" checked value="{{ 1 }}"/>
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
