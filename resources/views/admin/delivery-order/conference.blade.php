@extends('layouts.app')

@section('page-title', 'Ordem de Entrega')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="card-box">
                <h6 class="font-13 m-t-0 m-b-30">Conferência</h6>
                <form method="post" class="form-horizontal" action="{{route('delivery-order.store')}}">
                    {{csrf_field()}}

                    @foreach($documents as $document)
                      <input type="hidden" name="documents[]" value="{{ $document->uuid }}"/>
                    @endforeach

                    <div class="form-group {!! $errors->has('delivered_by') ? 'has-error' : '' !!}">
                      <label class="col-sm-12">Entregador</label>
                        <div class="col-sm-12">
                          <select class="select2 select-entregador" data-search-user="{{ route('user_search') }}" name="delivered_by" required>
                              <option value="">Selecione um entregador</option>
                              @foreach($delivers as $deliver)
                                  <option value="{{$deliver->uuid}}">{{$deliver->name}}</option>
                              @endforeach
                          </select>
                          {!! $errors->first('delivered_by', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('delivery_date') ? 'has-error' : '' !!}">
                      <label class="col-sm-12">Entrega</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control inputDate" name="delivery_date"/>
                            {!! $errors->first('delivery_date', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {!! $errors->has('annotations') ? 'has-error' : '' !!}">
                      <label class="col-sm-12">Anotações</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="annotations"></textarea>
                            {!! $errors->first('annotations', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <button class="btn btn-custom btn-block">Gerar</button>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card-box">
                @foreach($documents as $document)

                  <div class="col-lg-9">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title">
                              <h5>{{ $document->description }}, Gerado em: {{ $document->created_at->format('d/m/Y H:i') }}, Por {{ $document->creator->person->name }}</h5>
                          </div>
                          <div class="ibox-content">

                            <div class="row">

                              <div class="col-sm-12">

                                <address>
                                  <strong>{{ $document->client->name }}</strong><br>
                                  {{ $document->address->street }}, {{ $document->address->number }}, {{ $document->address->reference }} {{ $document->address->complement }}<br>
                                  {{ $document->address->district }}, {{ $document->address->city }} {{ $document->address->zip }}<br>
                                  <abbr title="Telefone">P:</abbr> {{ $document->client->phone }}
                                  <br/>
                                  <abbr title="E-mail">E-mail:</abbr>
                                  <a href="mailto:{{ $document->client->email }}">{{ $document->client->email }}</a>
                                </address>

                                <address>
                                  <strong>Entregador</strong><br>
                                  <span id="entregador"><span class="text-navy">Selecione o Entregador</span></span>
                                </address>

                              </div>

                            </div>

                          </div>
                      </div>
                  </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

      $(document).ready(function() {

        let selectEntregador = $(".select-entregador");
        let entregador = $("#entregador");

        selectEntregador.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

          let self = $(this);
          let route = self.data('search-user');
          let value = self.val();

          $.ajax({
            type: 'GET',
            url: route + '?param=' + value,
            async: true,
            success: function(response) {

              if(response.success) {

                let result = response.data;

                entregador.html("");
                let html = result.name + " - " + result.cpf;
                entregador.append(html);
              }


            }
          })


        });

      });

    </script>
@stop
