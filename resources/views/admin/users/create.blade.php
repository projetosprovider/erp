@extends('layouts.app')

@section('page-title', 'Usuários')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Novo Usuário</h6>

        <form method="post" action="{{route('users.store')}}">

            {{csrf_field()}}

            <div class="row m-b-30">

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Nome</label>
                      <div class="input-group">
                        <input type="text" required autocomplete="off" value="{{ old('name') }}" name="name" class="form-control">
                      </div>
                      {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {!! $errors->has('cpf') ? 'has-error' : '' !!}">
                      <label class="col-form-label">CPF</label>
                      <div class="input-group">
                        <input type="text" required value="{{ old('cpf') }}" name="cpf" class="form-control inputCpf">
                      </div>
                      {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
                  </div>

                </div>

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                      <label class="col-form-label">E-mail</label>
                      <div class="input-group">
                        <input type="email" required value="{{ old('email') }}" name="email" class="form-control">
                      </div>
                      {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                  </div>

                  <div class="form-group {!! $errors->has('birthday') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Nascimento</label>
                      <div class="input-group">
                        <input type="text" required value="{{ old('birthday') }}" name="birthday" class="form-control inputDate" autocomplete="off" data-date-end-date="0d">
                      </div>
                      {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Telefone</label>
                      <div class="input-group">
                        <input type="text" required value="{{ old('phone') }}" name="phone" class="form-control inputPhone">
                      </div>
                      {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                  </div>
                  <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Ativo</label>
                      <div class="input-group">
                        <input type="checkbox" data-plugin="switchery" value="1" {{ old('active') || !request()->has('active') ? 'checked' : '' }} name="active" class="form-control">
                      </div>
                      {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

            </div>

            <div class="row m-b-30">

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('department_id') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Departamento</label>
                      <div class="input-group">
                        <select class="select2 select-occupations" name="department_id" data-search-occupations="{{ route('occupation_search') }}" required>
                          @foreach($departments as $department)
                              <option value="{{$department->uuid}}">{{$department->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('occupation_id') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Cargo</label>
                      <div class="input-group">
                        <select class="select2 occupation" id="occupation" name="occupation_id" required>
                          @foreach($occupations as $occupation)
                              <option value="{{$occupation->uuid}}">{{$occupation->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      {!! $errors->first('occupation_id', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

            </div>

            <div class="row m-b-30">

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('roles') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Previlégio</label>
                      <div class="input-group">
                        <select id="roles" name="roles" required class="select2">
                          @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                      <label class="col-form-label">Senha de Acesso</label>
                      <div class="input-group">
                        <input type="password" autocomplete="off" value="{{ old('password') }}" name="password" class="form-control">
                      </div>
                      {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>

            </div>

            <button class="btn btn-custom">Salvar</button>
            <a class="btn btn-default" href="{{ route('users') }}">Cancelar</a>
        </form>

    </div>

@endsection
