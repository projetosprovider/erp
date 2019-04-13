<div class="modal inmodal" id="cadastra-consulta-modal" tabindex="-1" role="dialog" aria-hidden="true"  style="z-index:1041">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Agendamento</h4>
                <small>Registre nova turma</small>
            </div>

            <form id="formConsultaModal" method="POST" action="">
            <div class="modal-body">

                  {{  csrf_field() }}
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>Inicio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" id="consulta-inicio" name="inicio" required readonly class="form-control datetimepicker" data-date-format="dd/mm/yyyy hh:ii" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label>Fim</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input type="text" id="consulta-fim" name="fim" required readonly class="form-control datetimepicker" data-date-format="dd/mm/yyyy hh:ii" value="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Curso</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control selectpicker pacienteConsulta" title="Selecione um paciente" required data-style="btn-white" data-live-search="true" show-tick show-menu-arrow data-width="100%" name="paciente" id="consulta-paciente">
                                  @foreach(App\Helpers\Helper::courses() as $course)
                                      <option value="{{$course->id}}">{{$course->title}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Aluno</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control selectpicker pacienteConsulta" multiple title="Selecione um paciente" required data-style="btn-white" data-live-search="true" show-tick show-menu-arrow data-width="100%" name="paciente" id="consulta-paciente">
                                  @foreach(App\Helpers\Helper::courses() as $course)
                                      <option value="{{$course->id}}">{{$course->title}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Notas do agendamento</label>
                            <div class="input-group col-md-12 col-xs-12 col-sm-12">
                                <textarea class="form-control" rows="6" id="consulta-notas" name="notas"></textarea>
                            </div>
                        </div>
                    </div>

                    -->

                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" id="btnConsulta" class="btn btn-danger">Agendar</button>
            </div>
            </form>
        </div>
    </div>
</div>
