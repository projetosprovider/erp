@extends('layouts.app')

@section('page-title', 'Configurações')

@section('content')

    <div class="card-box">

      <form role="form" method="post" action="{{ route('configurations.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required/>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="nome">Descrição</label>
            <input type="text" class="form-control" id="description" name="description">
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
            <label for="type_id">Tipo</label>
            <select class="select2" id="type_id" name="type_id" placeholder="Tipo">
              @foreach($types as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
            {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="form-group valores" id="config-1">
            <label for="cidade">Valor</label>
            <input type="text" class="form-control" id="value" name="value" value="">
            {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="checkbox valores" id="config-2">
            <label>
              <input type="checkbox" name="ativo" data-plugin="switchery" value="1"> Habilitado
            </label>
          </div>

          <div class="form-group valores" id="config-3">
            <label for="value">Valor</label>
            <input type="file" class="form-control filestyle" data-size="md" data-buttontext="Selecione um arquivo" data-buttonname="btn-default" id="value" name="value"/>
            {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
          </div>

          <div class="form-group">
            <label for="value">Ativo</label>
            <input type="checkbox" name="active" value="1" data-plugin="switchery" checked/>
            {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
          </div>

          <br/>
          <br/>

          <button type="submit" class="btn btn-custom">Salvar</button>
          <a class="btn btn-default" href="{{ route('configurations.index') }}">Cancelar</a>

        </div>
      </form>

    </div>

@stop

@section('scripts')

  <script>

    function habilitarValor() {

      $('.valores').hide();

      var tipo = $("#type_id").val();

      $("#config-"+tipo).show();

    }

    $(document).ready(function() {

      habilitarValor();

      $("#type_id").change(function() {
        habilitarValor();
      });

    });

  </script>

@stop
