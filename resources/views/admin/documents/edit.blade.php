@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Documentos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('documents.index')}}">Documentos</a>
                </li>
                <li class="active">
                    <strong>Editar Documento</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

              @foreach ($errors->all() as $error)

                  <div class="alert alert-danger">{{ $error }}</div>

              @endforeach

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Novo Documento</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('documents.update', $document->uuid)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Descrição</label>
                                <div class="col-sm-10">
                                  <input type="text" required placeholder="Este campo é opcional" name="description" value="{{ $document->description }}" class="form-control"/>
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('client_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Cliente</label>
                                <div class="col-sm-10">
                                  <select class="selectpicker show-tick select-client-addresses" data-search-addresses="{{ route('client_addresses_search') }}" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="client_id" required>
                                        @foreach($clients as $client)
                                            <option value="{{$client->uuid}}" {{ $document->client_id == $client->id ? 'selected' : '' }}>{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                      {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}
                                  </div>
                            </div>

                            <div class="form-group {!! $errors->has('address_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Endereço</label>
                                <div class="col-sm-10">
                                  <select class="selectpicker show-tick" id="select-address" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="address_id" required>
                                    @foreach($document->client->addresses as $address)
                                        <option value="{{$address->uuid}}" {{ $document->address_id == $address->id ? 'selected' : '' }}>{{$address->description}}</option>
                                    @endforeach
                                  </select>
                                      {!! $errors->first('address_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {!! $errors->has('type_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Tipo</label>
                                <div class="col-sm-10">
                                  <select class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="type_id" required>
                                        @foreach($types as $type)
                                            <option value="{{$type->uuid}}" {{ $document->type_id == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                      {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
                                  </div>
                            </div>

                            <button class="btn btn-primary">Salvar</button>
                            <a class="btn btn-white" href="{{ route('documents.index') }}">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

      $(document).ready(function() {

        let selectClientAddress = $(".select-client-addresses");
        let selectAddress = $("#select-address");

        selectClientAddress.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

          let self = $(this);
          let route = self.data('search-addresses');
          let value = self.val();

          $.ajax({
            type: 'GET',
            url: route + '?param=' + value,
            async: true,
            success: function(response) {

              let html = "";
              selectAddress.html("");
              selectAddress.selectpicker('refresh');

              $.each(response.data, function(idx, item) {

                  html += "<option value="+ item.uuid +">"+ item.description +"</option>";

              });

              selectAddress.append(html);
              selectAddress.selectpicker('refresh');

            }
          })

        });

      });

    </script>
@endpush
