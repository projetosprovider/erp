@extends('layouts.app')

@section('page-title', 'Ordem de Entrega')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Ordem de Entrega</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>
                <li>
                    <a href="{{route('delivery-order.index')}}">Ordem de Entrega</a>
                </li>
                <li class="active">
                    <strong>Nova Ordem de Entrega</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nova Ordem de Entrega</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{route('delivery-order.store')}}">
                            {{csrf_field()}}


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
