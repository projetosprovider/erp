@extends('layouts.app')

@section('page-title', $client->name . ': Endereço')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Editar Cliente </h6>

    <form action="{{route('client_addresses_update', [$client->uuid, $address->uuid])}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
      <div class="row">

      <div class="form-group col-md-12"><label class="control-label">Descrição</label>
          <input type="text" name="description" value="{{ $address->description }}" required class="form-control" id="description" placeholder="Ex: Matriz">
      </div>

      <div class="form-group col-md-3"><label class="control-label">CEP</label>
          <input type="text" data-cep="{{ route('cep') }}" value="{{ $address->zip }}" name="zip" required class="form-control inputCep">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Rua</label>
          <input type="text" name="street" required class="form-control" id="street" value="{{ $address->street }}">
      </div>

      <div class="form-group col-md-3"><label class="control-label">Numero</label>
          <input type="text" name="number" class="form-control" id="number" value="{{ $address->number }}">
      </div>

      <div class="form-group col-md-4"><label class="control-label">Bairro</label>
          <input type="text" name="district" required class="form-control" id="district" value="{{ $address->district }}">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Cidade</label>
          <input type="text" name="city" required class="form-control" id="city" value="{{ $address->city }}">
      </div>

      <div class="form-group col-md-2"><label class="control-label">Estado</label>
          <input type="text" name="state" required class="form-control" id="state" value="{{ $address->state }}">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Complemento</label>
          <input type="text" name="complement" class="form-control" id="complement" value="{{ $address->complement }}">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Referência</label>
          <input type="text" name="reference" class="form-control" id="reference" value="{{ $address->reference }}">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Longitude</label>
          <input type="text" name="long" class="form-control" id="long" value="{{ $address->long }}">
      </div>

      <div class="form-group col-md-6"><label class="control-label">Latitude</label>
          <input type="text" name="lat" class="form-control" id="lat" value="{{ $address->lat }}">
      </div>

      <div class="form-group col-md-6">
          <input type="checkbox" name="is_default" id="is_default" value="1" {{ $address->is_default ? 'checked' : '' }}/>
          <label class="control-label">Endereço Principal</label>
      </div>

      </div>

      <button type="submit" class="btn btn-custom">Salvar</button>
      <a href="{{ route('clients.show', $client->uuid) }}" class="btn btn-default">Cancelar</a>

    </form>
</div>

@endsection
