@extends('layouts.app')

@section('page-title', 'Cargos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Editar Cargo</h6>

        <form method="post" action="{{route('occupations.update', $occupation->uuid)}}">
            {{csrf_field()}}
            {{method_field('PUT')}}

            <div class="row m-b-30">

                <div class="col-md-4">

                  <div class="form-group"><label class="col-form-label">Nome</label>
                      <div class="input-group"><input type="text" name="name" value="{{ $occupation->name }}" class="form-control" autofocus required/></div>
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group"><label class="col-form-label">Departamento</label>
                      <div class="input-group">
                        <select class="form-control m-b select2" name="department_id">
                            @foreach($departments as $department)
                                <option value="{{$department->uuid}}" {{ $department->id == $occupation->department_id ? 'selected' : '' }}>{{$department->name}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>

                </div>

            </div>

            <button class="btn btn-custom">Salvar</button>
            <a class="btn btn-default" href="{{ route('occupations.index') }}">Cancelar</a>
        </form>

    </div>

@endsection
