@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Sub Processo</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Subprocessos</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                @include('flash::message')

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Novo Subprocesso</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('sub_process_store')}}">
                            {{csrf_field()}}

                            <div class="row">

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group"><label class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10"><input type="text" name="name" autofocus required class="form-control"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Processo</label>
                                        <div class="col-sm-10">
                                          <select class="form-control m-b" required name="process_id">
                                                @foreach($processes as $process)
                                                    <option value="{{$process->id}}">{{$process->name}}</option>
                                                @endforeach
                                          </select></div>
                                    </div>
                                </div>



                            </div>

                            <button class="btn btn-primary">Salvar</button>
                            <a href="{{ route('subprocesses') }}" class="btn btn-white">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
