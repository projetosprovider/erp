@extends('layouts.app')

@section('page-title', 'Turma')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

      @if($team->status == 'RESERVADO')

          <form action="{{ route('team_start', $team->uuid) }}" method="POST" style="display: inline;">{{ csrf_field() }}
            <button class="btn btn-custom"><i class="ti-control-play"></i> <span>Iniciar Curso</span></button>
          </form>

      @endif

    @permission('create.clientes')

        <a class="btn btn-default text-success m-t-lg" data-toggle="modal" data-target=".addEmployee"><i class="fas fa-user-plus"></i> Novo Funcionário</a>

        <div class="modal fade addEmployee" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Adicionar Funcionário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <form method="post" action="{{route('teams_add_employees', ['id' => $team->uuid])}}">

                    <div class="modal-body">

                          {{csrf_field()}}
                          {{method_field('PUT')}}

                          <div class="form-group {!! $errors->has('employees') ? 'has-error' : '' !!}">
                              <label class="col-form-label" for="employees">Funcionários</label>
                              <div class="input-group">
                                <select class="form-control m-b select2" name="employees[]" multiple placeholder="Informe os Funcionários" required>
                                    @foreach($companies->sortBy('name') as $company)
                                      <optgroup label="{{ $company->name }}">
                                        @foreach($company->employees as $employee)

                                          @if(in_array($employee->id, $employeesSelected))
                                              @continue;
                                          @endif

                                          <option value="{{$employee->uuid}}">{{$employee->name}}</option>
                                        @endforeach
                                      </optgroup>
                                    @endforeach
                                </select>
                              </div>
                              {!! $errors->first('employees', '<p class="help-block">:message</p>') !!}
                          </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>

    @endpermission

    <button type="button" class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target=".editTeam"><i class="far fa-edit"></i> Editar Informações</button>

    <div class="modal fade editTeam" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Editar Informações</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <form method="post" action="{{route('teams.update', ['id' => $team->uuid])}}">

                <div class="modal-body">

                      {{csrf_field()}}
                      {{method_field('PUT')}}

                      <div class="row">

                          <div class="col-md-6">

                            <div class="form-group {!! $errors->has('course_id') ? 'has-error' : '' !!}">
                                <label class="col-form-label" for="course_id">Curso</label>
                                <div class="input-group">
                                  <select class="form-control m-b select2" name="course_id" required>
                                      @foreach($courses->sortBy('name') as $course)
                                            <option value="{{$course->uuid}}" {{ $team->course_id == $course->id ? 'selected' : '' }}>{{$course->title}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group {!! $errors->has('teacher_id') ? 'has-error' : '' !!}">
                                <label class="col-form-label" for="teacher_id">Instrutor</label>
                                <div class="input-group">
                                  <select class="form-control m-b select2" name="teacher_id" required>
                                      @foreach($teachers->sortBy('name') as $teacher)
                                            <option value="{{$teacher->user->uuid}}" {{ $team->teacher_id == $teacher->id ? 'selected' : '' }}>{{$teacher->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                                {!! $errors->first('teacher_id', '<p class="help-block">:message</p>') !!}
                            </div>

                          </div>

                          <div class="col-md-12" id="sandbox-container">
                            <label class="col-form-label" for="course_id">Data</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-md form-control inputDate" name="start" value="{{ $team->start->format('d/m/Y') }}"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">Até</span>
                                </div>
                                <input type="text" class="input-md form-control inputDate" name="end" value="{{ $team->end->format('d/m/Y') }}"/>
                            </div>
                          </div>

                          <div class="col-md-6">

                            <div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!}">
                                <label class="col-form-label" for="status">Status</label>
                                <div class="input-group">
                                  <select class="form-control m-b select2" name="status" required>
                                      <option value="RESERVADO" {{ $team->status == 'RESERVADO' ? 'selected' : '' }}>RESERVADO</option>
                                      <option value="EM ANDAMENTO" {{ $team->status == 'EM ANDAMENTO' ? 'selected' : '' }}>EM ANDAMENTO</option>
                                      <option value="FINALIZADA" {{ $team->status == 'FINALIZADA' ? 'selected' : '' }}>FINALIZADA</option>
                                      <option value="CANCELADA" {{ $team->status == 'CANCELADA' ? 'selected' : '' }}>CANCELADA</option>
                                  </select>
                                </div>
                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group {!! $errors->has('vacancies') ? 'has-error' : '' !!}">
                                <label class="col-form-label" for="vacancies">Vagas</label>
                                <div class="input-group">
                                    <input type="number" id="vacancies" name="vacancies" class="form-control" value="{{ $team->vacancies }}" required>

                                </div>
                                {!! $errors->first('vacancies', '<p class="help-block">:message</p>') !!}
                            </div>

                          </div>

                      </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>
                </div>

                </form>

            </div>
        </div>
    </div>

</div>

<div class="card-box">
  <div class="row widget style1">
      <div class="col-lg-6">
          <div class="m-b-md">

              <h3>{{ $teamCode }} </h3>
              <p>Curso: {{ $team->course->title }}</p>
              <p>Instrutor: {{ $team->teacher->person->name }}</p>
              <p class="text-primary">Data: {{ $team->start->format('d/m') }} à {{ $team->end->format('d/m') }}</p>
              <p class="text-muted">Situação: {{ $team->status }}</p>
              <p class="text-danger ">Carga horaria: {{ $team->course->workload }} hora(s)</p>

          </div>
      </div>

      <div class="col-lg-6">

          <p class="lead text-success title">{{$team->employees->count()}} de {{$team->vacancies}} vagas</p>
          <p class="">{{ round(($team->employees->count() / intval($team->vacancies)) * 100, 2) }}% de vagas preenchidas</p>

      </div>

  </div>
</div>

<div class="row">

  <div class="col-md-12">
    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Funcionários</h6>

        @if($team->employees->isNotEmpty())
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                      <th>Empresa</th>
                      <th>Nome</th>
                      <th>Situação</th>
                      <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($team->employees as $employeeItem)

                        @php
                            $employee = $employeeItem->employee;
                        @endphp

                        <tr>

                            <td class="project-title">
                                <a>{{$employee->company->name}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$employee->name}}</a>
                            </td>

                            <td class="project-title">
                                <span class="badge badge-custom">{{ $employeeItem->status }}</span>
                            </td>

                            <td class="project-actions" style="min-width:100px">

                              <button type="button" class="btn btn-default waves-effect waves-light btn-sm" data-toggle="modal"
                               data-target=".editStatus-{{ $loop->index }}"><i class="far fa-edit"></i></button>

                              @permission('delete.clientes')
                                <a data-route="{{route('teams_employee_destroy', [$team->uuid, $employeeItem->uuid])}}" data-reload="1" class="btn btn-default text-danger btn-sm btnRemoveItem"><i class="fas fa-close"></i> </a>
                              @endpermission
                            </td>

                        </tr>

                        <div class="modal fade editStatus-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mySmallModalLabel">{{$employee->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>

                                    <form method="post" action="{{route('teams.store')}}">

                                    <div class="modal-body">

                                          {{csrf_field()}}

                                          <div class="row m-b-30">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label class="col-form-label" for="status">Situação</label>
                                                      <div class="input-group">
                                                        <select class="form-control m-b select2" name="status" required>
                                                              <option value="PRE-AGENDADO">PRE-AGENDADO</option>
                                                              <option value="AGENDADO">AGENDADO</option>
                                                              <option value="CONFIRMADO">CONFIRMADO</option>
                                                              <option value="CANCELADO">CANCELADO</option>
                                                              <option value="FALTA">FALTA</option>
                                                        </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Salvar</button>
                                    </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
          </div>
        @else
          <div class="widget white-bg no-padding">
              <div class="p-m text-center">
                  <h1 class="m-md"><i class="far fa-folder-open fa-4x"></i></h1>
                  <h3 class="font-bold no-margins">
                      Nenhum registro encontrado.
                  </h3>

                  @permission('create.clientes')
                      <a href="{{route('client_employee_create', $team->uuid)}}" class="btn btn-default text-success p-m"><i class="fas fa-user-plus"></i> Novo Funcionário</a>
                  @endpermission
              </div>
          </div>
        @endif

    </div>
  </div>

</div>



@endsection

@section('js')

@endsection
