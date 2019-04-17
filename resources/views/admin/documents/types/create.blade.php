@extends('layouts.app')

@section('page-title', 'Tipos de Documentos')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Novo Documento</h6>

    <form method="post" action="{{route('types.store')}}">
        {{csrf_field()}}

        <div class="row m-b-30">

            <div class="col-md-4">

              <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                  <label class="col-form-label">Nome</label>
                  <div class="input-group">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" autofocus required/>
                  </div>
                  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
                  <label class="col-form-label">Valor Cobrado (R$)</label>
                  <div class="input-group">
                    <input type="text" name="price" value="{{ old('price') }}" class="form-control inputMoney" required/>
                  </div>
                  {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
              </div>

            </div>
        </div>

        <button class="btn btn-custom">Salvar</button>
        <a class="btn btn-default" href="{{ route('types.index') }}">Cancelar</a>
    </form>

</div>

@endsection
