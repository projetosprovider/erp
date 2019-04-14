@extends('layouts.app')

@section('page-title', 'Tipos de Recados')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Novo Tipo de Recado</h6>
        <form method="post" action="{{route('message-types.update', $type->uuid)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="row m-b-30">
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="col-form-label">Nome</label>
                      <div class="input-group">
                        <input type="text" required name="name" value="{{ $type->name }}" placeholder="Informe o novo tipo de Recado" class="form-control">
                      </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <button class="btn btn-custom">Salvar</button>
                  <a class="btn btn-default" href="{{ route('message-types.index') }}">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

@endsection
