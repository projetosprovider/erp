@extends('layouts.layout')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Mapeamentos</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li class="active">
                    <strong>Mapeamentos</strong>
                </li>
            </ol>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                @include('flash::message')

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Mapeamentos</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                            @if($mappings->isNotEmpty())
                            <table class="table table-hover table-responsive">
                                <tbody>
                                @foreach($mappings as $map)
                                <tr>
                                    <td class="project-title">
                                        <a href="{{route('mapping', ['id' => $map->id])}}">{{$map->name}}</a>
                                    </td>
                                    <td class="project-completion">
                                        <span>Tempo Tarefas {{ App\Http\Controllers\HomeController::minutesToHour($map->tasks->sum('time')) }}</span>
                                    </td>
                                    <td class="project-completion">
                                        <span>Tarefas: {{ $map->tasks->count() }}<a></span>
                                    </td>
                                    <td class="project-completion">
                                        <span>Tempo Trabalhado: {{App\Helpers\Mapper::getDoneTimeByUser($map->user->id) }}<a></span>
                                    </td>
                                    <td class="project-completion">
                                        <span>Tempo Ocioso: {{ App\Http\Controllers\TaskController::ociousTime($map->id) }}<a></span>
                                    </td>
                                    <td class="project-people hidden-xs">
                                        <a href="{{route('user', ['id' => $map->user->id])}}" title="{{ $map->user->name }}">
                                        <img alt="image" class="img-circle" src="{{Gravatar::get($map->user->email)}}"></a>
                                    </td>
                                    <!--<td class="project-actions hidden-xs">
                                        <a href="{{route('mapping_edit', ['id' => $map->id])}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                    </td>-->
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">Nenhum mapeamento foi registrado até o momento.</div>
                            @endif
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection
