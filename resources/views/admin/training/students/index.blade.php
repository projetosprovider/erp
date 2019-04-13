@extends('layouts.layout')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Alunos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Alunos</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            @permission('create.clientes')
                <a href="{{ route('students.create') }}" class="btn btn-primary btn-block dim m-t-lg">Novo Aluno</a>
            @endpermission

        </div>

    </div>


    <div class="row">
            <div class="wrapper wrapper-content animated fadeInUp">

                <div class="col-lg-12">

                    <div class="ibox">
                    <div class="ibox-title">
                        <h5>Listagem</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                            @if($students->isNotEmpty())
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach($students as $student)
                                            <tr>

                                                <td class="project-title">
                                                    <p>ID:</p>
                                                    <a>{{$student->id}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Nome:</p>
                                                    <a>{{$student->name}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>CPF:</p>
                                                    <a>{{$student->cpf}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Empresa:</p>
                                                    <a>{{$student->company->name}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Email:</p>
                                                    <a>{{$student->email}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Telefone:</p>
                                                    <a>{{$student->phone}}</a>
                                                </td>

                                                <td class="project-title">
                                                    <p>Adicionado em:</p>
                                                    <a>{{$student->created_at->format('d/m/Y H:i')}}</a>
                                                </td>

                                                <td class="project-actions">

                                                  @permission('create.cursos')
                                                    <a href="{{route('students.show', ['id' => $student->uuid])}}" class="btn btn-info btn-block"><i class="fa fa-list"></i> Visualizar</a>
                                                  @endpermission

                                                  @permission('edit.cursos')
                                                    <a href="{{route('students.edit', ['id' => $student->uuid])}}" class="btn btn-white btn-block"><i class="fa fa-pencil"></i> Editar</a>
                                                  @endpermission

                                                  @permission('delete.cursos')
                                                    <a data-route="{{route('students.destroy', ['id' => $student->uuid])}}" class="btn btn-danger btn-block btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                                  @endpermission
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $students->links() }}

                            @else
                                <div class="alert alert-warning text-center">Nenhum cliente registrado até o momento.</div>
                            @endif
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="modal inmodal" id="adicionar-cliente-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Novo Cliente</h4>
                    </div>
                    <form action="{{route('clients.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">

                        <div class="form-group"><label class="control-label">Nome</label>
                            <input type="text" name="name" autofocus required class="form-control">
                        </div>

                        <div class="form-group"><label class="control-label">Telefone</label>
                            <input type="text" name="phone" required class="form-control inputPhone">
                        </div>

                        <div class="form-group"><label class="control-label">Email</label>
                            <input type="email" name="email" required class="form-control">
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

  </script>

@endpush
