@extends('layouts.layout')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Turmas</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Turmas</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            @permission('create.clientes')
                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-block dim m-t-lg">Novo Curso</a>
            @endpermission

        </div>

    </div>


    <div class="row">
        <div class="wrapper wrapper-content animated fadeInRight">

          <div class="col-lg-8">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Calendário</h5>
                </div>
                <div class="ibox-content">
                    <div class="calendar"></div>
                </div>
            </div>

          </div>

          <div class="col-lg-4">

              <div class="ibox">
                
                  <div class="ibox-title">
                      <h5>Listagem</h5>
                  </div>
                  <div class="ibox-content">

                        <div class="project-list">
                            @if($teams->isNotEmpty())
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach($teams as $course)
                                            <tr>

                                                <td class="project-title">
                                                    <p>ID:</p>
                                                    <a>{{$course->id}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Titulo:</p>
                                                    <a>{{$course->title}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Descrição:</p>
                                                    <a>{{$course->description}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Carga Horária:</p>
                                                    <a>{{$course->workload}} horas</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Adicionado em:</p>
                                                    <a>{{$course->created_at->format('d/m/Y H:i')}}</a>
                                                </td>

                                                <td class="project-actions">
                                                  @permission('edit.cursos')
                                                    <a href="{{route('courses.edit', ['id' => $course->uuid])}}" class="btn btn-white btn-block"><i class="fa fa-pencil"></i> Editar</a>
                                                  @endpermission

                                                  @permission('delete.cursos')
                                                    <a data-route="{{route('courses.destroy', ['id' => $course->uuid])}}" class="btn btn-danger btn-block btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                                  @endpermission
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $courses->links() }}

                            @else
                                <div class="alert alert-warning text-center">Nenhum cliente registrado até o momento.</div>
                            @endif
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

      let $calendar = $('.calendar');

      $calendar.fullCalendar({
          views: {
            listDay: {
              buttonText: 'list day',
              titleFormat: "dddd, DD MMMM YYYY",
              columnFormat: "",
              timeFormat: "HH:mm"
            },

            listWeek: {
              buttonText: 'list week',
              columnFormat: "ddd D",
              timeFormat: "HH:mm"
            },

            listMonth: {
              buttonText: 'list month',
              titleFormat: "MMMM YYYY",
              timeFormat: "HH:mm"
            },

            month: {
              buttonText: 'month',
              titleFormat: 'MMMM YYYY',
              columnFormat: "ddd",
              timeFormat: "HH:mm"
            },

            agendaWeek: {
              buttonText: 'agendaWeek',
              columnFormat: "ddd D",
              timeFormat: "HH:mm"
            },

            agendaDay: {
              buttonText: 'agendaDay',
              titleFormat: 'dddd, DD MMMM YYYY',
              columnFormat: "",
              timeFormat: "HH:mm"
            },
          },
          lang: 'pt-br',
          defaultView: 'month',
          eventBorderColor: "#de1f1f",
          eventColor: "#AC1E23",
          slotLabelFormat: 'HH:mm',
          eventLimitText: 'consultas',
          minTime: '06:00:00',
          maxTime: '22:00:00',
          header: {
              left: 'prev,next,today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay,listMonth,listWeek'
          },

          navLinks: true,
          selectable: true,
          selectHelper: true,
          select: function(start, end, jsEvent, view) {

              var view = $('.calendar').fullCalendar('getView');

              if (view.name == 'agendaDay' || view.name == 'agendaWeek') {

                  //limparModal();

                  $("#cadastra-consulta-modal").modal('show');
                  $("#consulta-inicio").val(start.format('DD/MM/YYYY HH:mm'));
                  $("#consulta-fim").val(end.format('DD/MM/YYYY HH:mm'));

              }

          },
          eventClick: function(event, element, view) {
              popularModalAndShow(event);
          },
          editable: true,
          allDaySlot: false,
          eventLimit: true,
          dayClick: function(date, jsEvent, view) {

              jsEvent.preventDefault();

              setTimeout(function() {

                  //limparModal();

                  $("#formConsultaModal").prop('action', $("#consultas-store").val());

                  /*if (view.name == 'month') {
                      $('.calendar').fullCalendar('gotoDate', date);
                      $('.calendar').fullCalendar('changeView', 'agendaDay');
                  }*/

              }, 100);

          },
          events: $("#consultas-json").val(),
          color: 'black', // an option!
          textColor: 'yellow', // an option!
          //When u drop an event in the calendar do the following:
          eventDrop: function(event, delta, revertFunc) {
              //popularModal(event);
          },
          //When u resize an event in the calendar do the following:
          eventResize: function(event, delta, revertFunc) {
              //popularModal(event);
          },
          eventRender: function(event, element) {
              $(element).tooltip({
                  title: event.title
              });
          },
          ignoreTimezone: false,
          allDayText: 'Dia Inteiro',
          monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
          dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

          axisFormat: 'HH:mm',

          buttonText: {
              prev: "<",
              next: ">",
              prevYear: "Ano anterior",
              nextYear: "Proximo ano",
              today: "Hoje",
              month: "Mês",
              week: "Semana",
              day: "Dia",
              listMonth: "Lista Mensal",
              listWeek: "Lista Semanal",
              listDay: "Lista Diária"
          }

      });

      $('#cadastra-consulta-modal').on('hidden.bs.modal', function() {
          var form = $("#formConsultaModal").prop('action', $("#consultas-store").val());
          //limparModal();
          $("#btnConsulta").text("Marcar consulta");
      });

      $('.btnOpenModalReagendarConsulta').click(function() {

          var self = $(this);

          $("#formConsultaModal").prop('action', '/consults/' + self.data('id') + '/update');

          $("#cadastra-consulta-modal").modal('show');

          $("#consulta-inicio").val(self.data('inicio'));
          $("#consulta-fim").val(self.data('fim'));

          $('#consulta-status option')
              .removeAttr('selected')
              .filter('[value="' + self.data('status') + '"]')
              .attr('selected', true)

          $('#consulta-paciente').selectpicker('val', self.data('paciente'));

          $("#consulta-notas").val(self.data('notas'));

          $("#btnConsulta").text('Reagendar Consulta');

      });

      $("#formConsultaModal").submit(function(e) {

          var self = $(this);

          e.preventDefault();

          var inicio = self.find('#consulta-inicio').val();
          var fim = self.find('#consulta-fim').val();
          var status = self.find('#consulta-status').val();
          var paciente = self.find('#consulta-paciente').val();
          var notas = self.find('#consulta-notas').val();

          openSwalScreen();

          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "POST",
              url: self.attr('action'),
              data: {
                  inicio,
                  fim,
                  status,
                  paciente,
                  notas
              },
              dataType: 'json',
              async: true,
              success: function(data) {

                  if (data.code === 201) {
                      openSwalScreenProgressEditable('Sucesso', 'A consulta foi marcada.');
                      $("#cadastra-consulta-modal").modal('hide');
                      window.location.reload();
                  } else {
                      openSwalMessage('Ocorreu um erro no cadastro da consulta.', data.message);
                      $("#cadastra-consulta-modal").modal('show');
                  }

              },
              error: function(data) {
                  openSwalMessage('Erro inesperado', data.message);
              }
          })

      });

      $('.btnNovaConsulta').click(function() {
          var self = $(this);

          $("#formConsultaModal input, select, textarea").attr('disabled', false);
          $("#btnConsulta").show();

          limparModal();

          if (self.data('paciente')) {
              $('#consulta-paciente').selectpicker('val', self.data('paciente'));
          }

          $("#cadastra-consulta-modal").modal('show');
          $("#consulta-notas").val("");
      });

      $(".datetimepicker").datetimepicker();

      function popularModalAndShow(event) {
          $("#formConsultaModal").prop('action', '/consults/' + event.id + '/update');

          $("#cadastra-consulta-modal").modal('show');
          $("#cadastra-consulta-modal").find('#title').val(event.title);

          $("#consulta-inicio").val(event.start.format('DD/MM/YYYY HH:mm'));
          $("#consulta-fim").val(event.end.format('DD/MM/YYYY HH:mm'));

          $('#consulta-status option')
              .removeAttr('selected')
              .filter('[value="' + event.status + '"]')
              .attr('selected', true)

          $('#consulta-paciente').selectpicker('val', event.paciente);

          $("#consulta-notas").val(event.notas);

          if (event.status_id == 3 || event.status_id == 4) {
              $("#btnConsulta").hide();
              $("#formConsultaModal input, select, textarea").attr('disabled', true);
          } else if (event.status_id == 2) {
              $("#btnConsulta").html('Editar Consulta').show();
              $("#formConsultaModal input, select, textarea").attr('disabled', false);
          } else {
              $("#btnConsulta").show();
              $("#formConsultaModal input, select, textarea").attr('disabled', false);
          }

      }

  </script>

@endpush
