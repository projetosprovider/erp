@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Mapeamentos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('mappings')}}">Mapeamentos</a>
                </li>
                <li class="active">
                    <strong>Novo Mapeamento</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

              @include('flash::message')

              @foreach ($errors->all() as $error)

                  <div class="alert alert-danger">{{ $error }}</div>

              @endforeach

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Novo Mapeamento</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('mapping_store')}}">
                            {{csrf_field()}}
                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                  <input type="text" placeholder="Este campo é opcional" name="name" value="{{ old('name') }}" class="form-control"/>
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('user') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Usuário</label>
                                <div class="col-sm-10">
                                  <select class="selectpicker show-tick" data-style="btn-white" data-width="100%" name="user">
                                        @foreach($users as $user)
                                            @if($user->do_task && $user->active)
                                                <option value="{{$user->id}}" {{ Auth::user()->id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                      {!! $errors->first('user', '<p class="help-block">:message</p>') !!}
                                  </div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('mappings') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
