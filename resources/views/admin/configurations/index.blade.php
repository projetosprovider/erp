@extends('layouts.app')

@section('page-title', 'Configurações')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
          <a href="{{ route('configurations.create') }}" class="btn btn-success">Novo</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h6 class="m-t-0">Lista</h6>
            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th style="width:100px">#</th>
                    </tr>
                    </thead>

                    <tbody>
                      @foreach($configs as $config)
                        <tr>
                            <td>
                                {{ $config->name }}
                            </td>

                            <td>
                                {{ $config->description }}
                            </td>

                            <td>
                                @if(strlen($config->value) < 150)

                                  @if($config->type_id == 3)
                                    <img width="64" src="{{ route('image',['link'=>$config->value]) }}" class="img-thumbnail" alt="">
                                  @else
                                      {{ $config->value }}
                                  @endif


                                @else
                                    {{ 'Texto longo' }}
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('configurations.edit', $config->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                            </td>

                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
