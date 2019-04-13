@extends('layouts.layout')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Processos </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Processos</strong>
                </li>
            </ol>
        </div>
    </div>



        <div class="wrapper wrapper-content animated fadeInUp">
              <div class="row">

              @include('flash::message')

                @foreach($departments as $department)



                  <div class="{{ $isAdmin ? 'col-lg-4' : 'col-lg-12' }}">

                      @if(!$isAdmin && $department->id != $departmentUser)
                        @continue
                      @endif

                      <div class="ibox">
                      <div class="ibox-title">
                          <h5>{{ substr($department->name, 0, 25) }}</h5>
                          <div class="ibox-tools">
                            <a class="btn btn-xs btn-white btnAddProcess" data-tag="{{ $department->id }}">Adicionar</a>
                          </div>
                      </div>
                      <div class="ibox-content" style="{{ $isAdmin ? 'min-height: 300px;max-height: 300px;overflow-y: auto;' : '' }}">

                          <div class="project-list">

                              @if($department->processes->isNotEmpty())
                              <table class="table table-hover">
                                  <tbody>
                                  @foreach($department->processes as $process)

                                  @if($process->is_model)

                                  <tr>
                                      <td class="project-title">
                                          <a href="{{route('process', ['id' => $process->id])}}">{{$process->name}}</a>
                                          <!--<br/>
                                          <small><a class="text-navy" href="{{ route('department', ['id' => $process->department_id]) }}">{{$process->department->name}}</a></small>
                                        -->
                                      </td>
                                      <td class="project-actions">
                                          @if(\App\Http\Controllers\TaskController::existsTaskByProcess($process))
                                            <a href="{{ route('process_copy_clients', ['id' => $process->id]) }}" data-id="{{ $process->id }}" title="Gerar Tarefas" class="btn btn-xs btn-white" ><i class="fa fa-copy"></i> Gerar Tarefas</a>
                                          @else
                                            <a readonly class="btn btn-xs btn-white btnAlert" title="É necessário criar tarefas para gerá-las">Gerar Tarefas</a>
                                          @endif
                                          <a title="editar" href="{{route('process_edit', ['id' => $process->id])}}" class="btn btn-xs btn-white"><i class="fa fa-pencil"></i></a>
                                          <!--<a title="inativar" href="#" class="btn btn-xs btn-white"><i class="fa fa-trash-o"></i></a>-->
                                      </td>
                                  </tr>

                                  @endif

                                  @endforeach
                                  </tbody>
                              </table>
                              @else
                                  <div class="alert alert-warning text-center">Nenhum processo registrado até o momento.</div>
                              @endif
                          </div>
                      </div>
                  </div>

                  </div>
                @endforeach
            </div>
        </div>

        <div class="modal inmodal" id="copiar-processo-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Copiar Processo</h4>
                    </div>
                    <form action="{{route('process_copy')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="process_id" id="processId"/>
                            <div class="form-group"><label>Novo Processo</label>
                              <input type="text" required autofocus name="name" placeholder="Informe um nome à este processo" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="criar-processo-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Novo Processo</h4>
                    </div>
                    <form action="{{route('processes_store')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">

                                <div class="form-group"><label class="control-label">Nome</label>
                                    <input type="text" name="name" autofocus required class="form-control">
                                </div>

                                @if(Auth::user()->isAdmin())
                                  <div class="form-group">
                                    <label class="control-label">Departamento</label>

                                      <select class="form-control m-b" required name="department_id" id="department_id">
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{ !$isAdmin ? 'readonly="readonly"' : '' }} @if($isAdmin) {{ $departmentUser == $department->id || (isset($_GET['department']) && $_GET['department'] == $department->id) ? 'selected' : '' }} @endif>{{$department->name}}</option>
                                            @endforeach
                                      </select>

                                  </div>
                                @else
                                  <input type="hidden" name="department_id" class="form-control" value="{{ $departmentUser }}">
                                @endif

                                <!--<div class="form-group">
                                  <label class="control-label">É um modelo?</label>
                                      <input type="checkbox" name="is_model" value="1"/>
                                </div>-->

                                <div class="form-group">
                                  <label class="control-label">Frequencia</label>
                                      <select class="form-control m-b" name="frequency_id" id="frequencia" required>
                                        @foreach($frequencies as $frequency)
                                            <option value="{{$frequency->id}}">{{$frequency->name}}</option>
                                        @endforeach
                                      </select>
                                </div>


                                <div class="form-group semana">
                                  <label class="control-label">Dia da Semana</label>

                                      <select multiple title="Selecione uma opção" class="form-control selectpicker m-b" name="week_days[]" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%">
                                          <option value="monday">Segunda</option>
                                          <option value="tuesday">tuesday</option>
                                          <option value="wednesday">Quarta</option>
                                          <option value="thursday">Quinta</option>
                                          <option value="friday">Sexta</option>
                                          <option value="saturday">Sabado</option>
                                          <option value="sunday">Domingo</option>
                                      </select>
                                </div>

                                <div class="form-group periodo">
                                  <label class="control-label">Periodo</label>
                                      <div class="input-daterange input-group" id="datepicker">
                                          <input type="text" class="input-sm form-control" name="range_start" />
                                          <span class="input-group-addon">Até</span>
                                          <input type="text" class="input-sm form-control" name="range_end" />
                                      </div>
                                </div>

                                <div class="form-group horario">
                                    <label class="control-label">Horário</label>

                                      <div class="input-group clockpicker" data-autoclose="true">
                                        <input type="text" name="time" id="time" class="form-control" value="">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                      </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
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
          $(".btnCopiarProcesso").click(function() {
              console.log($(this).data('id'));
              $("#processId").val($(this).data('id'));
          });

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

      $("#frequencia").change(function() {

          var self = $(this);
          var frequencia = self.val();

          if(self.val() === '2') {

              horario.show();
              $("#time").val(hora + ':' + minutos);

          } else {
              horario.hide();
              $("#time").val("");
          }

          if(self.val() === '3') {
              semana.show();
              horario.show();
              $("#time").val(hora + ':' + minutos);
          } else {
              semana.hide();
          }

          if(self.val() === '4') {
              periodo.show();
          } else {
              periodo.hide();
          }

      });

      $(".btnAddProcess").click(function() {
        var self = $(this);
        $("#criar-processo-modal").modal('show');
        $("#department_id").val(self.data('tag'));
      });

      $(".btnAlert").click(function() {
        var self = $(this);

          toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
          toastr.warning(self.attr('title'), 'Alerta');

      });



  </script>

@endpush
