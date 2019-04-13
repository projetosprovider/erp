@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Usuários</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Usuários</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-block dim m-t-lg"><i class="fas fa-user-plus"></i> Novo Usuário</a>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

          <div class="col-lg-12">

              <div class="ibox">
                <div class="ibox-title">
                    <h5>Pesquisa</h5>
                </div>
                <div class="ibox-content">

                  <form method="get" action="?">
                    <div class="row">
                        <div class="col-md-3"><input name="search" type="text" placeholder="ID, Nome, Documento, Email, ou Telefone" class="form-control"></div>
                        <div class="col-md-2">
                          <select class="form-control selectpicker show-tick select-occupations" data-search-occupations="{{ route('occupation_search') }}" data-live-search="true" title="Departamento" data-style="btn-white" data-width="100%" placeholder="Departamento" name="department">
                            @foreach($departments as $department)
                                <option value="{{$department->uuid}}">{{$department->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                          <select class="form-control selectpicker show-tick" id="occupation" data-live-search="true" title="Cargo" data-style="btn-white" data-width="100%" placeholder="Cargo" name="occupation">

                          </select>
                        </div>
                        <div class="col-md-3">
                          <select class="form-control selectpicker show-tick" data-live-search="true" title="Situação" data-style="btn-white" data-width="100%" placeholder="Situação" name="active">
                              <option value="0">Inativo</option>
                              <option value="1">Ativo</option>
                          </select>
                        </div>
                        <div class="col-md-2"><button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Buscar</button></div>

                    </div>
                  </form>

                </div>
              </div>

            </div>

            @forelse($people as $person)

              <div class="col-md-4 m-b-sm">
                  <div class="ibox-content text-center">
                      <h1>{{ $person->name }}</h1>
                      <div class="m-b-sm">
                              <img alt="" class="img-circle rounded-circle" src="{{ route('image', ['user' => $person->user->uuid, 'link' => $person->user->avatar, 'avatar' => true])}}" style="max-width:128px;max-height:128px">
                      </div>

                      @if($person->active)
                          <i class="fa fa-circle text-navy"></i> Ativo
                      @else
                          <i class="fa fa-circle text-danger"></i> Inativo
                      @endif

                      <br/><br/>

                      <p class="font-bold">{{$person->user->email}}</p>
                      <p class=""><b>Nascimento:</b> {{$person->birthday->format('d/m/Y')}} ({{ \App\Helpers\Helper::idade($person) }})</p>
                      <p class=""><b>Cargo:</b> {{$person->department->name}} / {{$person->occupation->name}}</p>
                      <p class=""><b>Previlégio:</b> {{$person->user->roles->first()->name}}</p>
                      <p class=""><b>Ultimo login:</b> {{ $person->user->lastLoginAt() ? $person->user->lastLoginAt()->format('d/m/Y H:i') : '' }}</p>

                      <div class="text-center">
                          <a href="{{route('user', ['id' => $person->user->uuid])}}" class="btn btn-white"><i class="fa fa-link"></i> Acessar </a>
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

            <div class="text-center">
              {{ $people->links() }}
            </div>

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
