@extends('layouts.layout') @section('content')

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<h2>Tarefa Detalhes @if($pausedTask && $task->status_id == 2)<a class="text-center label label-info">Tarefa Pausada</a>@endif
			@if($task->status->id == 2)
				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-5 pull-right">
					<div class="example" data-timer="{{$remainTime}}"></div>
				</div>
			@endif
		</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('home') }}">Painel Principal</a>
			</li>
			<li class="active">
				<strong>Tarefa Detalhes</strong>
			</li>
		</ol>

	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-12">
		<div class="wrapper wrapper-content animated fadeInUp">

			@include('flash::message')

			<div class="ibox">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="m-b-md">
                <div class="btn-group pull-right">
                    <button data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle">Menu <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        @if($task->status_id == 2)
														@if(count($pausedTask) > 0)
														<li>
																<a class="btn-unpause">
																<i class="fa fa-play"></i> Continuar Tarefa</a>
														</li>
														@elseif(empty($taskDelay))
														<li>
																<a class="btn-pause">
																<i class="fa fa-pause"></i> Pausar Tarefa</a>
														</li>
														@endif
                            <li>
                                <a href="?status=3">
																<i class="fa fa-stop"></i> Finalizar Tarefa</a>
                            </li>
                        @elseif($task->status_id == 1)
                            <li>
																@if(($task->mapper && $task->mapper->active == 1) || !$task->mapper)
                                		<a href="?status=2"><i class="fa fa-play"></i> Iniciar Tarefa</a>
																@else
																		<a disabled id="btn-task-start-blocked"><i class="fa fa-play"></i> Iniciar Tarefa</a>
																@endif
                            </li>
														@if(($task->mapper) && $task->mapper->active != 1)
																<li><a href="{{ route('mapping', ['id' => $task->mapper->id]) }}"> Mapeamento</a></li>
														@endif
                        @endif
                        @if($task->status_id != 3 && $task->status_id != 4)
                            <li class="divider"></li>
                            <li>
                                <a href="?cancel=1"> Cancelar Tarefa</a>
                            </li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <a href="?duplicate=1"> Duplicar Tarefa</a>
                        </li>
                        @if($task->status_id != 3 && $task->status_id != 4)
                            <li><a href="{{ route('task_edit', ['id' => $task->id]) }}">Editar Tarefa</a></li>
                        @endif
                    </ul>
                </div>

								@if($gut > 50 && $gut < 100)
										<div class="alert alert-info">Esta tarefa exige uma atenção especial já que o seu indice GUT é {{ $gut }}</div>
								@elseif($gut >= 100)
										<div class="alert alert-danger">Esta tarefa é de altissima graviade, urgencia e tendencia já que o seu indice GUT é {{ $gut }}</div>
								@endif

								<h2>{{$task->name}} @if ($task->mapper) <small>({{ $task->mapper->name }})</small> @endif</h2>
							</div>

							<dl class="dl-horizontal">
								<dt>Descrição:</dt>
								<dd>
									<p>{{ $task->description }} </p>
								</dd>
							</dl>

							<dl class="dl-horizontal">
								<dt>Status:</dt>
								<dd>
									<span class="label label-primary">{{ $task->active ? 'Ativo' : 'Inativo' }} </span>
								</dd>
							</dl>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5">
							<dl class="dl-horizontal">
								<dt>Criado por:</dt>
								<dd>{{$task->createdBy->name}}</dd>
								<dt>Mensagens:</dt>
								<dd> {{ count($messages) }}</dd>
								<dt>Cliente:</dt>
								<dd>
									<a href="{{route('department', ['id' => $task->client->id])}}" class="text-navy"> {{$task->client->name}}</a>
								</dd>
								<dt>Fornecedor:</dt>
								<dd>
									<a href="{{route('department', ['id' => $task->vendor->id])}}" class="text-navy"> {{$task->vendor->name}}</a>
								</dd>

								<dt>Tempo Previsto:</dt>
								<dd>{{$task->time}} minutos</dd>
							</dl>
						</div>
						<div class="col-lg-4" id="cluster_info">
							<dl class="dl-horizontal">

								<dt>Ultima Atualização:</dt>
								<dd>{{$task->updated_at->format('d/m/Y H:i:s')}}</dd>
								<dt>Criado Em:</dt>
								<dd> {{$task->updated_at->format('d/m/Y H:i:s')}} </dd>
								<dt>Responsável:</dt>
								<dd class="project-people">
									<a href="{{route('user', ['id' => $task->sponsor->id])}}">
										<img alt="image" title="{{$task->sponsor->name}}" class="img-circle" src="{{Gravatar::get($task->sponsor->email)}}">
									</a>
								</dd>
							</dl>
						</div>

						<div class="col-lg-3 col-md-6">
							<dl class="dl-horizontal">
								<dt>Gravidade:</dt>
								<dd>
									<span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->severity); !!}">{{$task->severity}}</span>
								</dd>
								<dt>Urgencia:</dt>
								<dd>
									<span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->urgency); !!}">{{$task->urgency}}</span>
								</dd>
								<dt>Tendencia:</dt>
								<dd>
									<span class="label label-{!! App\Http\Controllers\TaskController::getColorFromValue($task->trend); !!}">{{$task->trend}}</span>
								</dd>
							</dl>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<dl class="dl-horizontal">
								<dt>Completada:</dt>
								<dd>
									<div class="progress progress-striped active m-b-sm">
											<div style="width:
											@if ($task->status_id == 1) 0%
											@elseif ($task->status_id == 2) 50%
											@elseif ($task->status_id == 3 || $task->status_id == 4) 100%
											@endif;" class="progress-bar
											@if ($task->status_id == 2) progress-bar-warning
											@elseif ($task->status_id == 4) progress-bar-danger
											@endif;"></div>
									</div>
								</dd>
							</dl>
						</div>
					</div>
					@if($task->begin)
					<div class="row">
						<div class="col-lg-12">
							<dl class="dl-horizontal">
								<dt>Inicio:</dt>
								<dd>{{ (new DateTime($task->begin))->format('d/m/Y H:i:s') }}</dd>
								@if($task->end)
								<dt>Fim:</dt>
								<dd>{{ (new DateTime($task->end))->format('d/m/Y H:i:s') }}</dd>
								@endif @if(($task->status_id == 3 || $task->status_id == 4))
								<dt>Tempo Gasto:</dt>
								<dd>{{ (new DateTime($task->end))->diff((new DateTime($task->begin)))->format("%H:%I:%S") }}</dd>
								@endif
							</dl>
						</div>
					</div>
					@endif

					<div class="row m-t-sm">
						<div class="col-lg-12">
							<div class="panel blank-panel">
								<div class="panel-heading">
									<div class="panel-options">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab-1" data-toggle="tab">Mensagens</a>
											</li>
											<li class="">
												<a href="#tab-2" data-toggle="tab">Atividades @if($logs->isNotEmpty())<span class="label label-defult">{{ count($logs) }}</span>@endif</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="panel-body">

									<div class="tab-content">
										<div class="tab-pane active" id="tab-1">
											<div class="feed-activity-list">
												@foreach($messages as $message)
												<div class="feed-element">
													<a href="{{route('user', ['id' => $message->user->id])}}" class="pull-left">
														<img alt="image" class="img-circle" src="{{Gravatar::get($message->user->email)}}">
													</a>
													<div class="media-body ">
														<small class="pull-right"></small>
														<strong>{{$message->user->name}}</strong>
														<br>
														<small class="text-muted">{{$message->created_at->format('d/m/Y H:i:s')}}</small>
														<div class="well">
															{{$message->message}}
														</div>
													</div>
												</div>
												@endforeach

												<div class="social-comment">
                            <a href="" class="pull-left">
                                <img style="max-width:32px;max-height:32px;margin-right:15px;" alt="image" src="{{Gravatar::get(Auth::user()->email)}}">
                            </a>
                            <div class="media-body">
															<form method="post" action="{{route('task_message_store')}}">
																{{csrf_field()}}
																<input name="task" type="hidden" value="{{$task->id}}"/>
                                <textarea name="message" class="form-control" required placeholder="Insira um Comentário"></textarea>
																<br/>
																<button class="btn btn-primary">Enviar</button>
															</form>
                            </div>
                        </div>

											</div>

										</div>
										<div class="tab-pane" id="tab-2">

											<div class="ibox-content inspinia-timeline">

			                    @foreach($logs as $log)
			                    <div class="timeline-item">
			                        <div class="row">
			                            <div class="col-xs-3 date">
			                                <i class="fa fa-comments"></i>
			                                {{ $log->created_at->format('H:i') }}
			                                <br>
			                                <small class="text-navy">{{ App\Helpers\TimesAgo::render($log->created_at) }}</small>
			                            </div>
			                            <div class="col-xs-7 content no-top-border">
			                                <p class="m-b-xs"><strong>{{$log->user->name == Auth::user()->name ? 'Você' : $log->user->name}}</strong></p>
			                                <p>{{ $log->message }}</p>
			                            </div>
			                        </div>
			                    </div>
			                    @endforeach
			                </div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if($task->mapper_id)
	<div class="col-lg-3 col-md-12">
		<div class="wrapper wrapper-content project-manager animated fadeInUp">
			<div class="ibox">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
								<h2>Proximas tarefas</h2>

								<table id="table" data-pagination="true"
                    data-toggle="table"
										data-url="{{ route('mapping_tasks_to_do', ['id' => $task->mapper_id]) }}"
                    data-striped="true"
                    data-click-to-select="true" data-flat="true"
                    style="cursor: pointer"
                >
                <thead>
                    <tr>
                        <th data-sortable="true" data-field="nome">Tarefa</th>
                        <th data-sortable="true" data-field="duracao">Duração</th>
                    </tr>
                </thead>
                </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif


	<div class="col-lg-3 col-md-12">
		<div class="wrapper wrapper-content project-manager animated fadeInUp">


			<input type="hidden" id="urlAPI" value="{{ route('task_delay', ['id' => $task->id]) }}"/>
			<input type="hidden" id="motivoEnviado" value="{{ count($taskDelay) }}"/>
			<input type="hidden" id="urlTaskPause" value="{{ route('task_pause', ['id' => $task->id]) }}"/>
			<input type="hidden" id="pausedTask" value="{{ count($pausedTask) }}"/>
			@if($pausedTask)
			<input type="hidden" id="urlTaskStart" value="{{ route('task_start', ['id' => $pausedTask->id]) }}"/>
			@endif

			@if(!empty($taskDelay->message))
					<div class="ibox">
						<div class="ibox-content">
							<div class="row">
								<div class="col-lg-12">
									<div class="m-b-md">
										<h2>Motivo do Atraso</h2>

										<p>{{ $taskDelay->message }}</p>

									</div>
								</div>
							</div>
						</div>
					</div>
			@endif

		</div>
	</div>
</div>

<input type="hidden" id="task_user" value="{{ $task->sponsor->id }}">
<input type="hidden" id="session_user" value="{{ \Auth::user()->id }}">

@endsection @push('scripts')

<script>
	$(document).ready(function() {

				var options = {
						"start": true,
						"fg_width": 0.05,
            "time": {
            "Days": {
                "text": "Days",
                "color": "#FFCC66",
                "show": false
            },
            "Hours": {
                "text": "Hora(s)",
                "color": "#1ab394",
                "show": true
            },
            "Minutes": {
                "text": "Minutos",
                "color": "#1ab394",
                "show": true
            },
            "Seconds": {
                "text": "Segundos",
                "color": "#1ab394",
                "show": true
            }
					}};

        $(".example").TimeCircles(options).addListener(countdownComplete);

				var pausedTask = $('#pausedTask').val();

				if(pausedTask > 0) {
					$(".example").TimeCircles(options).stop();
				}

        function countdownComplete(unit, value, total){
            if(total<=0){
                $(".example").TimeCircles().destroy();
                $(this).fadeOut('slow').replaceWith("<div class='alert alert-danger'>Tempo Expirado!</div>");

								if($('#motivoEnviado').val() > 0) {
										return false;
								}

								if($('#task_user').val() != $('#session_user').val()) {
									return false;
								}

								swal({
									  title: 'Informe o motivo do Atraso',
										customClass: 'bounceInLeft',
									  input: 'textarea',
									  confirmButtonText: 'Enviar',
									  showLoaderOnConfirm: true,
									  preConfirm: (text) => {
									    return new Promise((resolve) => {
									      setTimeout(() => {
									        if (text === '') {
									          swal.showValidationError(
									            'Por Favor Informe o motivo do atraso.'
									          )
									        }
									        resolve()
									      }, 2000)
									    })
									  },
									  allowOutsideClick: () => false
									}).then((result) => {
									  if (result.value) {

											const ipAPI = $('#urlAPI').val();

									    swal({
									      type: 'success',
									      title: 'O motivo foi enviado!',
									      html: 'Motivo: ' + result.value,
												preConfirm: () => {
													 return $.post(ipAPI, { message : result.value, _token : "{{ csrf_token() }}" }).then((data) => {
														 setTimeout(function() {
																 toastr.options = {
																		 closeButton: true,
																		 progressBar: true,
																		 showMethod: 'slideDown',
																		 timeOut: 4000
																 };
																 toastr.success('Mapeador de Processos', data.message);

																 setTimeout(function() {
																	 	window.location.reload();
																 }, 4000)

														 }, 1300);
													 })
												 }
									    })
									  }
									})
            }

            if(value>(total/1000)){
                $('.example').css({
                    'background-color' : '#fff'
                })
            }
        }

        });

				$(".btn-pause").click(function() {
					swal({
							title: 'Informe o motivo para pausar a tarefa.',
							customClass: 'bounceInLeft',
							input: 'textarea',
							confirmButtonText: 'Enviar',
							showLoaderOnConfirm: true,
							showCancelButton: true,
							preConfirm: (text) => {
								return new Promise((resolve) => {
									setTimeout(() => {
										if (text === '') {
											swal.showValidationError(
												'Por Favor Informe o motivo do atraso.'
											)
										}
										resolve()
									}, 2000)
								})
							},
							allowOutsideClick: () => false
						}).then((result) => {
							if (result.value) {

								const ipAPI = $('#urlTaskPause').val();

								swal({
									type: 'success',
									title: 'O motivo foi enviado!',
									html: 'Motivo: ' + result.value,
									preConfirm: () => {
										 return $.post(ipAPI, { id: {{ $task->id }}, message : result.value, _token : "{{ csrf_token() }}" }).then((data) => {
											 setTimeout(function() {
													 toastr.options = {
															 closeButton: true,
															 progressBar: true,
															 showMethod: 'slideDown',
															 timeOut: 4000
													 };
													 toastr.success('Mapeador de Processos', data.message);

													 setTimeout(function() {
															window.location.reload();
													 }, 2000)

											 }, 1300);
										 })
									 }
								})
							}
						})
				});

				$(".btn-unpause").click(function() {
					swal({
						  title: 'Deseja Continuar a tarefa?',
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Sim',
						  cancelButtonText: 'Cancelar',
						  confirmButtonClass: 'btn btn-success',
						  cancelButtonClass: 'btn btn-danger',
						  buttonsStyling: true,
						  reverseButtons: true
						}).then((result) => {
						  if (result.value) {

								const urlAPITaskStart = $('#urlTaskStart').val();

								$.post(urlAPITaskStart, { id: {{ $task->id }}, message : result.value, _token : "{{ csrf_token() }}" }).then((data) => {
									setTimeout(function() {
											toastr.options = {
													closeButton: true,
													progressBar: true,
													showMethod: 'slideDown',
													timeOut: 4000
											};
											toastr.success('Mapeador de Processos', data.message);

											setTimeout(function() {
												 window.location.reload();
											}, 2000)

									}, 1300);
								})


						    swal(
						      'OK!',
						      'Agora é só continuar na tarefa.',
						      'success'
						    )
						  // result.dismiss can be 'cancel', 'overlay',
						  // 'close', and 'timer'
						  }
						})
				});

				$("#btn-task-start-blocked").click(function() {
					toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 6000
					};
					toastr.warning('Esta tarefa Pertence a um mapeamento, deve primeiro iniciá-lo.', 'Alerta');
				});

</script>

@endpush
