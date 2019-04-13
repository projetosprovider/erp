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
                    <strong>Nova Tarefa</strong>
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
                        <h5>Nova Tarefa</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('task_store')}}">
                            {{csrf_field()}}

                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group {!! $errors->has('process_id') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">SubProcesso</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" id="select-processes" data-style="btn-white"  title="Selecione um Processo" data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="sub_process_id">
                                                @foreach($subprocesses as $subprocess)
                                                    <option value="{{$subprocess->id}}" @if(isset($_GET['sub_process'])) {{ $_GET['sub_process'] == $subprocess->id ? 'selected' : ''}} @endif>{{$subprocess->name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('process_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Descrição</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" required name="description" id="description" rows="3"
                                                   placeholder="Descreva a tarefa e informações relevantes." class="form-control"></textarea>
                                                   {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Responsável</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-style="btn-white" title="Selecione um Resposável" data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="user_id" required>

                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ $user->id == Auth::user()->id ? 'selected' : '' }}>{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('time') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Tempo</label>
                                        <div class="col-sm-10">

                                          <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" required name="time" id="time" class="form-control" value="00:30">
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
                                                  <option value="manual">Manual</option>
                                                  <option value="sistema">Sistema</option>
                                                  <option value="internet">Internet</option>
                                                  <option value="outros">Outros</option>
                                              </select>
                                              {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {!! $errors->has('indicator') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">indicador</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="indicator" placeholder="Sem Indicador" class="form-control"/>
                                            {!! $errors->first('indicator', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('client_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Cliente</label>
                                        <div class="col-sm-10"><select class="selectpicker" title="Selecione um Cliente" data-style="btn-white" required data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="client_id">

                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                          {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}</div>
                                    </div>

                                    <div class="form-group {!! $errors->has('vendor_id') ? 'has-error' : '' !!}"><label class="col-sm-2 control-label">Fornecedor</label>
                                        <div class="col-sm-10"><select class="selectpicker" title="Selecione um Fornecedor" data-style="btn-white" required data-live-search="true" show-tick show-menu-arrow data-width="100%"  name="vendor_id">

                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                          {!! $errors->first('vendor_id', '<p class="help-block">:message</p>') !!}</div>
                                    </div>

                                    <div class="form-group {!! $errors->has('severity') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Gravidade</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="severity">
                                                <option value="1" data-content="<span class='label label-default'>1 (baixissima)</span>">1 (baixissima)</option>
                                                <option value="2" data-content="<span class='label label-primary'>2 (baixa)</span>">2 (baixa)</option>
                                                <option value="3" data-content="<span class='label label-success'>3 (moderada)</span>">3 (moderada)</option>
                                                <option value="4" data-content="<span class='label label-warning'>4 (alta)</span>">4 (alta)</option>
                                                <option value="5" data-content="<span class='label label-danger'>5 (altissima)</span>">5 (altissima)</option>
                                            </select>
                                            {!! $errors->first('severity', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('urgency') ? 'has-error' : '' !!}">
                                        <label class="col-sm-2 control-label">Urgencia</label>
                                        <div class="col-sm-10">
                                            <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="urgency">
                                              <option value="1" data-content="<span class='label label-default'>1 (baixissima)</span>">1 (baixissima)</option>
                                              <option value="2" data-content="<span class='label label-primary'>2 (baixa)</span>">2 (baixa)</option>
                                              <option value="3" data-content="<span class='label label-success'>3 (moderada)</span>">3 (moderada)</option>
                                              <option value="4" data-content="<span class='label label-warning'>4 (alta)</span>">4 (alta)</option>
                                              <option value="5" data-content="<span class='label label-danger'>5 (altissima)</span>">5 (altissima)</option>
                                            </select>
                                            {!! $errors->first('urgency', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('trend') ? 'has-error' : '' !!}">
                                      <label class="col-sm-2 control-label">Tendencia</label>
                                      <div class="col-sm-10">
                                          <select class="selectpicker" data-live-search="true" data-style="btn-white" show-tick show-menu-arrow data-width="100%"  name="trend">
                                            <option value="1" data-content="<span class='label label-default'>1 (baixissima)</span>">1 (baixissima)</option>
                                            <option value="2" data-content="<span class='label label-primary'>2 (baixa)</span>">2 (baixa)</option>
                                            <option value="3" data-content="<span class='label label-success'>3 (moderada)</span>">3 (moderada)</option>
                                            <option value="4" data-content="<span class='label label-warning'>4 (alta)</span>">4 (alta)</option>
                                            <option value="5" data-content="<span class='label label-danger'>5 (altissima)</span>">5 (altissima)</option>
                                          </select>
                                          {!! $errors->first('trend', '<p class="help-block">:message</p>') !!}
                                      </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-primary">Salvar</button>
                                    <a href="{{route('tasks')}}" class="btn btn-white" onclick="openSwalPageLoader();">Cancelar</a>
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
