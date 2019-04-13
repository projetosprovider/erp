@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Tarefa</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Editar Tarefa</strong>
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
                        <h5>Editar Tarefa</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('task_update', ['id' => $task->id])}}">
                            {{csrf_field()}}

                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group {!! $errors->has('process_id') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">SubProcesso</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" id="select-processes" data-style="btn-white"  title="Selecione um Processo" data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="sub_process_id">
                                                @foreach($subprocesses as $subprocess)
                                                    <option value="{{$subprocess->id}}" {{$task->sub_process_id == $subprocess->id ? 'selected' : ''}}>{{$subprocess->name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('process_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Descrição</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" required name="description" id="description" rows="3"
                                                   placeholder="Descreva a tarefa e informações relevantes." class="form-control">{{$task->description}}</textarea>
                                                   {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Responsável</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-style="btn-white" title="Selecione um Resposável" data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="user_id" required>
                                                <option value="random">Aleatório</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ $user->id == $task->user_id ? 'selected' : '' }}>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('time') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Tempo</label>
                                        <div class="col-sm-10">

                                          <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" required name="time" id="time" class="form-control" value="{{$time}}">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                          </div>
                                          {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {!! $errors->has('method') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Metodo</label>
                                        <div class="col-sm-10">
                                              <select class="selectpicker" data-style="btn-white" data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="method">
                                                <option value="manual" {{ "manual" == $task->method ? 'selected' : '' }}>Manual</option>
                                                <option value="sistema" {{ "sistema" == $task->method ? 'selected' : '' }}>Sistema</option>
                                                <option value="internet" {{ "internet" == $task->method ? 'selected' : '' }}>Internet</option>
                                                <option value="outros" {{ "outros" == $task->method ? 'selected' : '' }}>Outros</option>
                                              </select>
                                              {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {!! $errors->has('indicator') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">indicador</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="indicator" placeholder="Sem Indicador" class="form-control" value="{{$task->indicator}}"/>
                                            {!! $errors->first('indicator', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('client_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Cliente</label>
                                        <div class="col-sm-10"><select class="selectpicker" title="Selecione um Cliente" data-style="btn-white" required data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="client_id">

                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}" {{ $department->id == $task->client_id ? 'selected' : '' }}>{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                          {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}</div>
                                    </div>

                                    <div class="form-group {!! $errors->has('vendor_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Fornecedor</label>
                                        <div class="col-sm-10"><select class="selectpicker" title="Selecione um Fornecedor" data-style="btn-white" required data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="vendor_id">

                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}" {{ $department->id == $task->vendor_id ? 'selected' : '' }}>{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                          {!! $errors->first('vendor_id', '<p class="help-block">:message</p>') !!}</div>
                                    </div>

                                    <div class="form-group {!! $errors->has('severity') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Gravidade</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="severity">
                                              <option value="1" {{ 1 == $task->severity ? 'selected' : '' }}>1 (baixissima)</option>
                                              <option value="2" {{ 2 == $task->severity ? 'selected' : '' }}>2 (baixa)</option>
                                              <option value="3" {{ 3 == $task->severity ? 'selected' : '' }}>3 (moderada)</option>
                                              <option value="4" {{ 4 == $task->severity ? 'selected' : '' }}>4 (alta)</option>
                                              <option value="5" {{ 5 == $task->severity ? 'selected' : '' }}>5 (altissima)</option>
                                            </select>
                                            {!! $errors->first('severity', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('urgency') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Urgencia</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="urgency">
                                              <option value="1" {{ 1 == $task->urgency ? 'selected' : '' }}>1 (baixissima)</option>
                                              <option value="2" {{ 2 == $task->urgency ? 'selected' : '' }}>2 (baixa)</option>
                                              <option value="3" {{ 3 == $task->urgency ? 'selected' : '' }}>3 (moderada)</option>
                                              <option value="4" {{ 4 == $task->urgency ? 'selected' : '' }}>4 (alta)</option>
                                              <option value="5" {{ 5 == $task->urgency ? 'selected' : '' }}>5 (altissima)</option>
                                            </select>
                                            {!! $errors->first('urgency', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('trend') ? 'has-error' : '' !!}">
                                      <label class="col-sm-2 control-label">Tendencia</label>
                                      <div class="col-sm-10">
                                          <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="trend">
                                            <option value="1" {{ 1 == $task->trend ? 'selected' : '' }}>1 (baixissima)</option>
                                            <option value="2" {{ 2 == $task->trend ? 'selected' : '' }}>2 (baixa)</option>
                                            <option value="3" {{ 3 == $task->trend ? 'selected' : '' }}>3 (moderada)</option>
                                            <option value="4" {{ 4 == $task->trend ? 'selected' : '' }}>4 (alta)</option>
                                            <option value="5" {{ 5 == $task->trend ? 'selected' : '' }}>5 (altissima)</option>
                                          </select>
                                          {!! $errors->first('trend', '<p class="help-block">:message</p>') !!}
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-primary">Salvar</button>
                                    <a href="{{route('task', ['id' => $task->id])}}" class="btn btn-white">Cancelar</a>
                                </div>

                              </div>
                            </div>

                            <div class="row">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

  <script>

      $('.clockpicker').clockpicker();

      $(document).ready(function() {
        $('#select-processes').change(function() {
            //$('#description').val($('#select-processes option:selected').text());
        });
        //$('#description').val($('#select-processes option:selected').text());
      });
  </script>

@endpush
