@extends('layouts.app')

@section('page-title', 'Departamentos')

@section('content')

<div class="card-box">
    <h6 class="font-13 m-t-0 m-b-30">Novo Departamento</h6>

    <form method="post" action="{{route('department_store')}}">
        @csrf

        <div class="row m-b-30">

            <div class="col-md-4">

              <div class="form-group">
                  <label class="col-form-label">Nome</label>
                  <div class="input-group">
                    <input type="text" required name="name" class="form-control">
                  </div>
              </div>

            </div>

            <div class="col-md-4">

              <div class="form-group">
                  <label class="col-form-label">Resposável</label>
                  <div class="input-group">
                    <select class="form-control m-b select2" name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->person->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

            </div>
        </div>
        
        <button class="btn btn-custom">Salvar</button>
        <a class="btn btn-default" href="{{ route('departments') }}">Cancelar</a>
    </form>

</div>

@endsection
