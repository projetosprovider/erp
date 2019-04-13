@extends('layouts.layout')

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Ordem Entrega</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('home') }}">Painel Principal</a>
                    </li>
                    <li class="active">
                        <strong>Ordem Entrega</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
                <a href="{{route('delivery-order.create')}}" class="btn btn-primary btn-block dim m-t-lg">Nova Ordem de Entrega</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Ordem Entrega</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">
                            @if($orders->isNotEmpty())
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Cliente</th>
                                      <th>Status</th>
                                      <th>Entregador</th>
                                      <th>Adicionado em</th>
                                      <th>Tempo passado</th>
                                      <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="project-title">
                                        #{{ str_pad($order->id, 6, "0", STR_PAD_LEFT)  }}
                                    </td>

                                    <td class="project-title">
                                        <a>{{ $order->client->name }}</a>
                                    </td>

                                    <td class="project-title">
                                        {{ $order->status->name }}
                                    </td>

                                    <td class="project-title">
                                        {{ $order->user->person->name }}
                                    </td>

                                    <td class="project-title">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="project-title">
                                        {{ $order->created_at->diffForHumans() }}
                                    </td>

                                    <td class="project-title">

                                      @permission('edit.documentos')
                                        <a href="{{route('print_tags', ['id' => $order->uuid])}}" class="btn btn-white btn-sm"><i class="fa fa-print"></i> Imprimir Etiqueta </a>
                                      @endpermission

                                      @permission('edit.documentos')
                                        <a href="{{route('delivery-order.edit', ['id' => $order->uuid])}}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editar </a>
                                      @endpermission

                                      @permission('delete.documentos')
                                        <a data-route="{{route('documents.destroy', ['id' => $order->uuid])}}" class="btn btn-white btn-sm btnRemoveItem"><i class="fa fa-close"></i> Cancelar </a>
                                      @endpermission
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">Nenhuma ordem de entrega foi registrada até o momento.</div>
                            @endif
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>

@endsection
