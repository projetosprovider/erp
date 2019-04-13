@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Cursos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}">Alunos</a>
                </li>
                <li class="active">
                    <strong>Editar Aluno</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Aluno</h5>
                    </div>
                    <div class="ibox-content">

                      <form method="post" class="form-horizontal" action="{{route('students.update', $student->uuid)}}">

                          {{csrf_field()}}
                          {{method_field('PUT')}}

                          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $student->name }}" name="name" class="form-control" autofocus required/>

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
                              <input type="text" value="{{ $student->cpf }}" name="cpf" class="form-control inputCpf" required/>

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
                                      @foreach($companies as $company)
                                          <option value="{{$company->id}}" {{ $student->company_id == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                      @endforeach
                                </select>
                                {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
                              </div>
                          </div>

                          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                              <input type="text" value="{{ $student->email }}" name="email" class="form-control"/>

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
                              <input type="text" value="{{ $student->phone }}" name="phone" class="form-control inputPhone"/>

                              @if ($errors->has('phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                  </span>
                              @endif

                            </div>
                          </div>



                          <button class="btn btn-primary">Salvar</button>
                          <a class="btn btn-white" href="{{ route('students.index') }}">Cancelar</a>
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
