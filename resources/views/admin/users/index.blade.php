@extends('layouts.app')

@section('page-title', 'Usuários')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.usuarios')
          <a href="{{ route('users.create') }}" class="btn btn-custom dim m-t-lg"><i class="fas fa-user-plus"></i> Novo Usuário</a>
        @endpermission

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Pesquisa</h6>

        <form method="get" action="?">
          <div class="row">
              <div class="col-md-3"><input name="search" type="text" placeholder="ID, Nome, Documento, Email, ou Telefone" class="form-control"></div>
              <div class="col-md-2">
                <select class="form-control select2 select-occupations" data-search-occupations="{{ route('occupation_search') }}" data-live-search="true" title="Departamento" data-style="btn-white" data-width="100%" placeholder="Departamento" name="department">
                  <option value="">Selecionar Departamento</option>
                  @foreach($departments as $department)
                      <option value="{{$department->uuid}}">{{$department->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control select2" id="occupation" data-live-search="true" title="Cargo" data-style="btn-white" data-width="100%" placeholder="Cargo" name="occupation">
                    <option value="">Selecionar Departamento</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control select2" data-live-search="true" title="Situação" data-style="btn-white" data-width="100%" placeholder="Situação" name="active">
                    <option value="">Situação</option>
                    <option value="0">Inativo</option>
                    <option value="1">Ativo</option>
                </select>
              </div>
              <div class="col-md-2"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Buscar</button></div>

          </div>
        </form>

    </div>

    <div class="row">

        @forelse($people as $person)

          <div class="col-md-4">
              <div class="text-center card-box">
                  <div class="member-card mt-4">
                      <span class="user-badge bg-custom">{{$person->department->name}}</span>
                      <div class="thumb-xl member-thumb m-b-10 center-page">
                          <img src="{{ route('image', ['user' => $person->user->uuid, 'link' => $person->user->avatar, 'avatar' => true])}}" class="rounded-circle img-thumbnail" alt="profile-image">


                          @if($person->active)
                              <i class="mdi mdi-information-outline member-star text-success" title="Ativo"></i>
                          @else
                              <i class="mdi mdi-information-outline member-star text-danger" title="Inativo"></i>
                          @endif

                      </div>

                      @if($person->active)
                          <i class="fa fa-circle text-success"></i> Ativo
                      @else
                          <i class="fa fa-circle text-danger"></i> Inativo
                      @endif

                      <div class="">
                          <h5 class="m-b-5 mt-2">{{ $person->name }}</h5>
                          <p class="text-muted">{{$person->occupation->name}} <span> | </span>
                            <span> <a href="#" class="text-pink">{{$person->user->email}}</a> </span></p>
                      </div>

                      <p class="text-muted font-13"></p>
                      <p class="text-muted font-13">{{$person->birthday->format('d/m/Y')}} <br/>({{ \App\Helpers\Helper::idade($person) }})</p>
                      <p class="text-muted font-13">Login: {{ $person->user->lastLoginAt() ? $person->user->lastLoginAt()->format('d/m/Y H:i') : '-' }}</p>

                      <a href="{{route('user', ['id' => $person->user->uuid])}}" class="btn btn-default btn-sm m-t-10 text-muted">Acessar Perfil</a>

                  </div>

              </div>

          </div>

        @empty

          <div class="col-md-12 m-b-sm">
            <div class="widget white-bg no-padding">
                <div class="p-m text-center">
                    <h1 class="m-xs"><i class="far fa-folder-open fa-4x"></i></h1>
                    <h3 class="font-bold no-margins">
                        Nenhum registro encontrado, para o parametros informados.
                    </h3>
                </div>
            </div>
          </div>

        @endforelse

        <div class="col-md-12 p-m text-center table-responsive">
          {{ $people->links() }}
        </div>

    </div>

@endsection

@push('scripts')
    <script>

      $(document).ready(function() {

        let selectOccupations = $(".select-occupations");
        let occupation = $("#occupation");

        selectOccupations.on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

          let self = $(this);
          let route = self.data('search-occupations');
          let value = self.val();

          $.ajax({
            type: 'GET',
            url: route + '?param=' + value,
            async: true,
            success: function(response) {

              let html = "";
              occupation.html("");
              occupation.selectpicker('refresh');

              $.each(response.data, function(idx, item) {

                  html += "<option value="+ item.uuid +">"+ item.name +"</option>";

              });

              occupation.append(html);
              occupation.selectpicker('refresh');

            }
          })

        });

      });

    </script>
@endpush
