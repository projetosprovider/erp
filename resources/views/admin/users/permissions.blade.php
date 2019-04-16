@extends('layouts.app')

@section('page-title', 'Regras de Acesso')

@section('content')

    <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                  <div class="row">

                    <div class="col-lg-12">

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

@endsection

@push('scripts')
    <script>

      $(".btnPermissionGrant").click(function(e) {

          var self = $(this);

          swal({
            title: 'Conceder esta Permissão?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {

              e.preventDefault();

              $.ajax({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url: self.data('route'),
                type: 'POST',
                dataType: 'json',
                data: {}
              }).done(function(data) {

                if(data.success) {

                  const toast = swal.mixin({
                    toast: true,
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 3000
                  });

                  toast({
                    type: 'success',
                    title: 'Ok!, permissão concedida.'
                  });

                  self.addClass('hidden');

                  self.parents('.project-actions')
                  .find('.btnPermissionRevoke')
                  .removeClass('hidden');

                } else {

                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: data.message,
                  })

                }

              });
            }
          });

      });

      $(".btnPermissionRevoke").click(function(e) {

          var self = $(this);

          swal({
            title: 'Revogar esta Permissão?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {

              e.preventDefault();

              $.ajax({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url: self.data('route'),
                type: 'POST',
                dataType: 'json',
                data: {}
              }).done(function(data) {

                if(data.success) {

                  const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });

                  toast({
                    type: 'success',
                    title: 'Ok!, permissão revogada.'
                  });

                  self.addClass('hidden');

                  self.parents('.project-actions')
                  .find('.btnPermissionGrant')
                  .removeClass('hidden');

                } else {

                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: data.message,
                  })

                }

              });
            }
          });

      });

    </script>
@endpush
