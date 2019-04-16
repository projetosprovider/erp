@extends('layouts.app')

@section('page-title', 'Ordem de Entrega')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        <a href="{{route('delivery-order.create')}}" class="btn btn-custom m-t-lg">Nova Ordem de Entrega</a>

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Pesquisar</h6>

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Listagem</h6>

        <div class="table-responsive">
            @if($orders->isNotEmpty())
            <table class="table table-hover">
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
                        <a href="{{ route('clients.show', $order->client->uuid) }}"><b>{{ $order->client->name }}</b></a>
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
                        <a href="{{route('print_tags', ['id' => $order->uuid])}}" target="_blank" class="btn btn-custom btn-block"><i class="fa fa-print"></i> Imprimir Etiqueta </a>
                      @endpermission

                      @permission('edit.documentos')
                        <a href="{{route('delivery-order.edit', ['id' => $order->uuid])}}" class="btn btn-default btn-block"><i class="fa fa-pencil"></i> Editar </a>
                      @endpermission

                      @permission('delete.documentos')
                        <a data-route="{{route('documents.destroy', ['id' => $order->uuid])}}" class="btn btn-danger btn-block btnRemoveItem"><i class="fa fa-close"></i> Cancelar </a>
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

@endsection
