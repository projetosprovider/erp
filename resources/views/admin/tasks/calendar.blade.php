@extends('layouts.layout')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">

    <style>
        #calendar {

        overflow-x:hidden;
        overflow-y:hidden;

        }
    </style>
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Tarefas<a href="{{route('task_create')}}" class="btn bottom-right btn-primary pull-right">Criar Tarefa</a></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Tarefas</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Tarefas</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

  <script src="{{asset('admin/js/plugins/fullcalendar/moment.min.js')}}"></script>
  <script src="{{asset('admin/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

  <script>

    let $calendar = $('#calendar');

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
            //popularModalAndShow(event);
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
            popularModal(event);
        },
        //When u resize an event in the calendar do the following:
        eventResize: function(event, delta, revertFunc) {
            popularModal(event);
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
/*
      $(document).ready(function() {
        $('#calendar').fullCalendar({
            height: 340,
            contentHeight: 700,
            lang: 'es',
            defaultView: 'agendaDay',
            eventBorderColor: "#de1f1f",
              minTime: '07:00:00',
              maxTime: '23:00:00',
             header:
            {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

              navLinks: true,
              selectable: true,
              selectHelper: true,
              select: function(start, end, jsEvent, view) {



              },
              eventClick: function(event, element, view) {



              },
              editable: false,
              eventLimit: true, // allow "more" link when too many
              dayClick: function(date, jsEvent, view) {

                  jsEvent.preventDefault();

                  $('#calendar').fullCalendar('gotoDate', date);
                  $('#calendar').fullCalendar('changeView','agendaDay');


              },
              events: '{{ route("tasks_json") }}',
              color: 'black',     // an option!
              textColor: 'yellow', // an option!
              //When u drop an event in the calendar do the following:
              eventDrop: function (event, delta, revertFunc) {
                //popularModal(event);
              },
              //When u resize an event in the calendar do the following:
              eventResize: function (event, delta, revertFunc) {
                //popularModal(event);
              },
              eventRender: function(event, element) {
                  //$(element).tooltip({title: event.title});
              },
              ignoreTimezone: false,
              allDayText: 'Dia Inteiro',
              monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
              monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
              dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
              dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
              titleFormat: {
                  month: 'MMMM YYYY',
                  week: "MMMM YYYY",
                  day: 'dddd, DD MMMM YYYY'
              },
              columnFormat: {
                  month: 'ddd',
                  week: 'ddd D',
                  day: ''
              },
              axisFormat: 'HH:mm',
              timeFormat: {
                  '': 'HH:mm',
                  agenda: 'HH:mm - HH:mm'
              },
              buttonText: {
                  prev: "<",
                  next: ">",
                  prevYear: "Ano anterior",
                  nextYear: "Proximo ano",
                  today: "Hoje",
                  month: "Mês",
                  week: "Semana",
                  day: "Dia"
              }

    });

      });
          */
  </script>

@endpush
