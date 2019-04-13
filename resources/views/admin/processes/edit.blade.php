@extends('layouts.layout')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Processo</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Editar Processo</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                @include('flash::message')

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Editar Processo</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('process_update', ['id' => $process->id])}}">
                            {{csrf_field()}}
                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10"><input type="text" name="name" value="{{$process->name}}" class="form-control"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>
                                        <div class="col-sm-10"><select class="form-control m-b" name="department_id">
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}" {{ $department->id == $process->department->id ? 'selected' : '' }}>{{$department->name}}</option>
                                                @endforeach
                                            </select></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Frequencia</label>
                                        <div class="col-sm-10"><select class="form-control m-b" name="frequency_id" id="frequencia">
                                                @foreach($frequencies as $frequency)
                                                    <option value="{{$frequency->id}}" {{ $process->frequency_id == $frequency->id ? 'selected' : '' }}>{{$frequency->name}}</option>
                                                @endforeach
                                            </select></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">

                                    <div class="form-group semana">
                                      <label class="col-sm-2 control-label">Dia da Semana</label>
                                        <div class="col-sm-10">
                                          <select multiple title="Selecione uma opção" class="form-control selectpicker m-b" name="week_days[]" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%">
                                              <option value="monday" {{ $process->monday ? 'selected' : '' }}>Segunda</option>
                                              <option value="tuesday" {{ $process->tuesday ? 'selected' : '' }}>tuesday</option>
                                              <option value="wednesday" {{ $process->wednesday ? 'selected' : '' }}>Quarta</option>
                                              <option value="thursday" {{ $process->thursday ? 'selected' : '' }}>Quinta</option>
                                              <option value="friday" {{ $process->friday ? 'selected' : '' }}>Sexta</option>
                                              <option value="saturday" {{ $process->saturday ? 'selected' : '' }}>Sabado</option>
                                              <option value="sunday" {{ $process->sunday ? 'selected' : '' }}>Domingo</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="form-group periodo">
                                      <label class="col-sm-2 control-label">Periodo</label>
                                        <div class="col-sm-10">
                                          <div class="input-daterange input-group" id="datepicker">
                                              <input type="text" class="input-sm form-control" name="range_start" value="{{$process->range_start ? $process->range_start->format('d/m/Y') : '' }}" />
                                              <span class="input-group-addon">Até</span>
                                              <input type="text" class="input-sm form-control" name="range_end" value="{{$process->range_end ? $process->range_end->format('d/m/Y') : ''}}" />
                                          </div>
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('time') ? 'has-error' : '' !!} horario">
                                        <label class="col-sm-2 control-label">Horário</label>
                                        <div class="col-sm-10">

                                          <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" name="time" id="time" class="form-control" value="{{$process->time}}">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                          </div>
                                          {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-primary">Salvar</button>
                            <a href="{{ route('process', ['id' => $process->id]) }}" class="btn btn-white">Cancelar</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.jquery.min.js"></script>

  <script>

      var periodo = $(".periodo");
      var semana = $(".semana");
      var horario = $(".horario");

      periodo.hide();
      semana.hide();
      horario.hide();

      $('.clockpicker').clockpicker();

      $(".select-date").chosen();

      $(document).ready(function() {
          $('.input-daterange').datepicker({
            format: "dd/mm/yyyy",
            clearBtn: true,
            todayHighlight: true,
            autoclose: true,
            language: "pt-BR"
          });
      });

      var tempo = new Date();
      var hora = tempo.getHours();
      var minutos = tempo.getMinutes();

      function tratarFrequencia(self)
      {
        var frequencia = self.val();

        if(self.val() === '2') {
            horario.show();
        } else {
            horario.hide();
        }

        if(self.val() === '3') {
            semana.show();
            horario.show();
        } else {
            semana.hide();
        }

        if(self.val() === '4') {
            periodo.show();
        } else {
            periodo.hide();
        }
      }

      $("#frequencia").change(function() {
          tratarFrequencia($(this));
      });

      tratarFrequencia($("#frequencia option:selected"));

  </script>

@endpush
