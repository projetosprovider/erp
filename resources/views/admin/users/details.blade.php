@extends('layouts.app')

@section('page-title', 'Perfil')

@push('stylesheets')
        <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="p-0 text-center">
                <div class="member-card">
                    <div class="thumb-xl member-thumb m-b-10 center-page">
                        <img src="{{ route('image', ['user' => $person->user->uuid, 'link' => $person->user->avatar, 'avatar' => true])}}" class="rounded-circle img-thumbnail" alt="">


                        @if($person->active)
                            <i class="mdi mdi-star-circle member-star text-success" title="Ativo"></i>
                        @else
                            <i class="mdi mdi-alert-circle-outline member-star text-danger" title="Inativo"></i>
                        @endif

                    </div>

                    <div class="">
                        <h5 class="m-b-5 mt-3">{{ $person->name }}</h5>
                        <p class="text-muted">{{$person->department->name}} / {{$person->occupation->name}}</p>
                    </div>

                    <button class="btn btn-default m-t-10" data-toggle="modal" data-target="#editar-senha">Alterar Senha</button>

                </div>

            </div> <!-- end card-box -->

        </div> <!-- end col -->
    </div>

    <div class="m-t-30">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    Perfil
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                    Configurações
                </a>
            </li>
            <li class="nav-item">
                <a href="#permissions" data-toggle="tab" aria-expanded="true" class="nav-link">
                    Permissões
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="home-b1">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Informações Pessoais</h3>
                            </div>
                            <div class="panel-body">
                                <div class="m-b-20">
                                    <strong>Nome</strong>
                                    <br>
                                    <p class="text-muted">{{ $person->name }}</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Telefone</strong>
                                    <br>
                                    <p class="text-muted">{{ $person->phone ?? 'Não informado' }}</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Email</strong>
                                    <br>
                                    <p class="text-muted">{{ $person->user->email }}</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>CPF</strong>
                                    <br>
                                    <p class="text-muted">{{ $person->cpf }}</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Departamento</strong>
                                    <br>
                                    <p class="text-muted">{{$person->department->name}}</p>
                                </div>
                                <div class="m-b-20">
                                    <strong>Cargo</strong>
                                    <br>
                                    <p class="text-muted">{{$person->occupation->name}}</p>
                                </div>

                                <div class="about-info-p m-b-0">
                                    <strong>Ultimo Login</strong>
                                    <br>
                                    <p class="text-muted">{{ $person->user->lastLoginAt() ? $person->user->lastLoginAt()->format('d/m/Y H:i') : '-' }}</p>
                                </div>

                            </div>
                        </div>
                        <!-- Personal-Information -->

                        <!-- Social -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Log de Acessos</h3>
                            </div>
                            <div class="panel-body">

                              <div class="timeline timeline-left">

                                  @forelse($person->user->authentications as $login)

                                  <article class="timeline-item">
                                      <div class="timeline-desk">
                                          <div class="panel">
                                              <div class="timeline-box">
                                                  <span class="arrow"></span>
                                                  <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                  <h4 class="timeline-date">{{ \App\Helpers\TimesAgo::render($login->login_at) }}</h4>
                                                  <p class="timeline-date text-muted">Logou em: {{ $login->login_at->format('d/m/Y H:i:s') }}</p>
                                                  <p class="timeline-date text-muted">Tempo de sessão: {{ \App\Helpers\TimesAgo::diffBetween($login->login_at, $login->logout_at) }}</p>
                                              </div>
                                          </div>
                                      </div>
                                  </article>

                                  @empty
                                      <div class="alert alert-warning">
                                          Voce não possui nenhum log até o momento>.
                                      </div>
                                  @endforelse

                              </div>

                            </div>
                        </div>
                        <!-- Social -->
                    </div>

                    <div class="col-md-8">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Atividades</h3>
                            </div>
                            <div class="panel-body">

                              <div class="timeline timeline-left">

                                  @forelse($activities as $activity)

                                  <article class="timeline-item">
                                      <div class="timeline-desk">
                                          <div class="panel">
                                              <div class="timeline-box">
                                                  <span class="arrow"></span>
                                                  <span class="timeline-icon {{ array_random(['', 'bg-success', 'bg-primary', 'bg-danger']) }}"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                  <h4 class="">{{ \App\Helpers\TimesAgo::render($activity->created_at) }}</h4>
                                                  <p class="timeline-date text-muted"><small>{{ $activity->created_at->format('H:i') }}</small></p>
                                                  <p>{{ $activity->description }}:
                                                     {{ html_entity_decode(\App\Helpers\Helper::getTagHmtlForModel($activity->subject_type, $activity->subject_id)) }} </p>
                                              </div>
                                          </div>
                                      </div>
                                  </article>

                                  @empty
                                      <div class="alert alert-warning">
                                          Voce não possui nenhum log até o momento>.
                                      </div>
                                  @endforelse

                              </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="tab-pane" id="profile-b1">

                <div class="row">

                    <div class="col-md-8">

                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Editar Perfil</h3>
                            </div>
                            <div class="panel-body">

                                <form enctype="multipart/form-data" action="{{route('user_update', ['id' => $user->id])}}" method="post">
                                    {{csrf_field()}}

                                    <div class="row m-b-30">

                                        <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="col-form-label">Nome</label>
                                              <div class="input-group">
                                                <input type="text" required name="name" value="{{$user->person->name}}" class="form-control">
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="col-form-label">Departamento</label>
                                              <div class="input-group">
                                                <select class="select2 select-occupations" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" data-search-occupations="{{ route('occupation_search') }}" name="department_id" required>
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->uuid}}" {{ $user->person->department_id == $department->id ? 'selected' : '' }}>{{$department->name}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="col-form-label">Avatar</label>
                                              <div class="input-group">
                                                <input type="file" name="avatar" class="filestyle" accept="image/*"/>
                                              </div>
                                          </div>

                                        </div>

                                        <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="col-form-label">CPF</label>
                                              <div class="input-group">
                                                <input type="text" required name="cpf" value="{{$user->person->cpf}}" class="form-control">
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="col-form-label">Cargo</label>
                                              <div class="input-group">
                                                <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%"  id="occupation" name="occupation_id" required>

                                                    @foreach($occupations as $occupation)
                                                        <option value="{{$occupation->uuid}}" {{ $user->person->occupation_id == $occupation->id ? 'selected' : '' }}>{{$occupation->name}}</option>
                                                    @endforeach

                                                </select>
                                              </div>
                                          </div>

                                          <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!}">
                                              <label class="col-form-label" for="active">Ativo</label>
                                              <div class="input-group">
                                                  <input type="checkbox" id="active" name="active" {{ $user->active ? 'active' : '' }} data-plugin="switchery" checked value="{{ 1 }}">

                                              </div>
                                              {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
                                          </div>

                                        </div>

                                        <div class="col-md-4">
                                          <div class="form-group">
                                              <label class="col-form-label">E-mail</label>
                                              <div class="input-group">
                                                <input type="email" readonly name="email" value="{{$user->email}}" class="form-control">
                                              </div>
                                          </div>

                                          @php

                                            $day = null;

                                            if($user->person->birthday) {
                                              $day = $user->person->birthday->format('d/m/Y');
                                            }

                                          @endphp

                                          <div class="form-group">
                                              <label class="col-form-label">Nascimento</label>
                                              <div class="input-group">
                                                <input type="text" name="birthday" value="{{$day}}" class="form-control inputDate">
                                              </div>
                                          </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-custom">Salvar</button>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                      <div class="panel panel-default panel-fill">
                          <div class="panel-heading">
                              <h3 class="panel-title">Editar Configurações</h3>
                          </div>
                          <div class="panel-body">

                            <form action="{{route('user_update_configurations', ['id' => $user->uuid])}}" method="post">
                                @csrf

                                <div class="row m-b-30">

                                  <div class="col-md-12">

                                      <div class="form-group">
                                          <label class="col-form-label">Usuário SOC</label>
                                          <div class="input-group">
                                            <input type="text" name="login_soc" value="{{ $user->login_soc ?? '' }}" class="form-control">
                                          </div>
                                      </div>

                                  </div>

                                  <div class="col-md-12">

                                      <div class="form-group">
                                          <label class="col-form-label">Senha SOC</label>
                                          <div class="input-group">
                                            <input type="text" name="password_soc" value="{{$user->password_soc ?? ''}}" class="form-control" autocomplete="off">
                                          </div>
                                      </div>

                                  </div>

                                  <div class="col-md-12">

                                      <div class="form-group">
                                          <label class="col-form-label">ID SOC</label>
                                          <div class="input-group">
                                            <input type="text" name="id_soc" value="{{$user->id_soc??''}}" class="form-control">
                                          </div>
                                      </div>

                                  </div>

                                  <div class="col-md-12">

                                      <div class="form-group {!! $errors->has('roles') ? 'has-error' : '' !!}">
                                          <label class="col-form-label">Previlégios</label>
                                          <div class="input-group">
                                            <select id="role" name="roles" required="required" class="select2" title="Selecione">
                                              @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
                                      </div>

                                  </div>

                                  <div class="col-md-12">

                                    <div class="form-group {!! $errors->has('do_task') ? 'has-error' : '' !!}">
                                        <label class="col-form-label" for="do_task">Executa Tarefas</label>
                                        <div class="input-group">
                                            <input type="checkbox" id="do_task" name="do_task" {{ $user->do_task ? 'active' : '' }} data-plugin="switchery" checked value="{{ 1 }}">
                                        </div>
                                        {!! $errors->first('do_task', '<p class="help-block">:message</p>') !!}
                                    </div>

                                  </div>

                                </div>

                                <button type="submit" class="btn btn-custom">Salvar</button>
                            </form>

                          </div>
                      </div>

                  </div>

                </div>

            </div>
            <div class="tab-pane" id="permissions">

                  <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-default panel-fill">
                            <div class="panel-heading">
                                <h3 class="panel-title">Editar Permissões</h3>
                            </div>
                            <div class="panel-body">

                              <div class="panel-group" id="accordion">

                                @foreach($modules as $key => $module)

                                    @if($module->children->isNotEmpty())

                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h5 class="panel-title">
                                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->index }}" class="collapsed" aria-expanded="false">{{$module->name}}</a>
                                              </h5>
                                          </div>
                                          <div id="collapse{{ $loop->index }}" class="panel-collapse {{ $key==0 ? 'in' : '' }} collapse" style="">
                                              <div class="panel-body">

                                                @forelse($module->children as $item)

                                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                                  <h2>
                                                      {{$item->name}}
                                                  </h2>
                                                </div>

                                                <table class="table table-borderd">
                                                    <tbody>
                                                    @foreach($item->permissions as $permission)

                                                    @php
                                                        $hasPermission = $user->hasPermission($permission->slug);
                                                    @endphp

                                                    <tr>
                                                        <td class="project-title">
                                                            <p>Acesso:</p>
                                                            <a href="#">{{$hasPermission ? 'SIM' : 'NÃO'}}</a>
                                                        </td>
                                                        <td class="project-title">
                                                            <p>Nome:</p>
                                                            <a href="#">{{$permission->name}}</a>
                                                        </td>
                                                        <td class="project-title">
                                                            <p>Descrição:</p>
                                                            <a href="#">{{$permission->description}}</a>
                                                        </td>
                                                        <td class="project-actions">

                                                            <input type="checkbox" class="checkboxPermissions" {{ $hasPermission ? 'checked' : '' }}
                                                              data-route-grant="{{route('user_permissions_grant', [$user->uuid, $permission->id])}}"
                                                              data-route-revoke="{{route('user_permissions_revoke', [$user->uuid, $permission->id])}}"
                                                              data-plugin="switchery" value="1"/>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                @empty
                                                    <div class="alert alert-warning">Nenhum sub-processo registrado até o momento.</div>
                                                @endforelse

                                              </div>
                                          </div>
                                      </div>

                                    @endif

                                @endforeach

                              </div>

                            </div>
                        </div>

                    </div>

                  </div>

            </div>

        </div>

    </div>

    <div class="modal inmodal" id="editar-senha" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                  <h4 class="modal-title">Alterar Senha</h4>
                </div>
                <form action="{{route('user_update_password', ['id' => $user->uuid])}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group"><label>Nova Senha</label>
                          <input type="password" required autofocus name="password" placeholder="Informe a sua nova senha" autocomplete="off" class="form-control">

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
