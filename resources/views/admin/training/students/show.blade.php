@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Alunos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}">Alunos</a>
                </li>
                <li class="active">
                    <strong>{{ $student->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

              <div class="ibox">
                  <div class="ibox-content">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="m-b-md">
                                  <a href="{{route('students.edit', ['id' => $student->uuid])}}"
                                     style="margin-left: 4px;"
                                     class="btn btn-info pull-right">Editar</a>
                                  <h2>{{ $student->name}} </h2>
                                  <p>CPF/CNPJ: {{ $student->cpf }}</p>
                                  <p>Email: {{ $student->email }}</p>
                                  <p>Telefone: {{ $student->phone }}</p>
                                  <p>Biometria cadastrada? <b>{{ $student->biometric ? 'SIM' : 'NÂO' }}</b></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Histórico</h5>
                    </div>
                    <div class="ibox-content">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
