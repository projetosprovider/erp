@extends('layouts.app')

@section('page-title', $role->name . ' Permissões')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Listagem de Permissões</h6>

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

                          <div class="table-responsive">
                          <table class="table table-borderd">
                              <tbody>
                              @foreach($item->permissions as $permission)

                              @php

                                  $hasPermission = \App\Models\RoleDefaultPermissions::where('role_id', $role->id)
                                  ->where('permission_id', $permission->id)
                                  ->get()->first();

                              @endphp

                              <tr>
                                  <td class="project-actions">

                                      <input type="checkbox" class="checkboxPermissions" {{ $hasPermission ? 'checked' : '' }}
                                        data-route-grant="{{route('role_permissions_grant', [$role->id, $permission->id])}}"
                                        data-route-revoke="{{route('role_permissions_revoke', [$role->id, $permission->id])}}"
                                        data-plugin="switchery" value="1"/>

                                  </td>
                                  <td class="project-title">
                                      <p>Nome:</p>
                                      <a href="#">{{$permission->name}}</a>
                                  </td>
                                  <td class="project-title">
                                      <p>Descrição:</p>
                                      <a href="#">{{$permission->description}}</a>
                                  </td>

                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                          </div>
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

@endsection
