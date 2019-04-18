@extends('layouts.app')

@section('page-title', 'Previlégios')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.departamentos')
          <a href="{{route('roles.create')}}" class="btn btn-custom m-t-lg">Nova Regra</a>
        @endpermission

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Listagem</h6>

        <div class="table-responsive">
            @if($roles->isNotEmpty())
            <table class="table table-hover">
                <thead>

                  <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Opções</th>
                  </tr>

                </thead>

                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td class="project-title">
                        {{$role->name}}
                    </td>
                    <td class="project-title">
                        {{$role->description}}
                    </td>
                    <td class="project-actions">
                        <a href="{{route('roles.show', ['id' => $role->id])}}" class="btn btn-default"><i class="fa fa-key"></i> Permissões</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning">Nenhum sub-processo registrado até o momento.</div>
            @endif
        </div>

    </div>

@endsection
