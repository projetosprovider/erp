@extends('layouts.auth')

@section('content')

<div class="m-t-40 card-box">
    <div class="text-center">
        <h2 class="text-uppercase m-t-0 m-b-30">
            <a href="{{ route('home') }}" class="text-success">
                <span><img src="{{ asset('simple/images/logo-provider.png') }}" alt="" height="64"></span>
            </a>
        </h2>
        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
    </div>
    <div class="account-content">
        <div class="text-center m-b-20">
            <img src="{{ asset('simple/images/cancel.svg') }}" title="invite.svg" height="80" class="m-t-10">
            <h3 class="expired-title mb-4 mt-2">Página não Encontrada!</h3>
            <p class="text-muted m-t-20 line-h-24"> {{ $message }} </p>
        </div>

        <div class="row m-t-30">
            <div class="col-12">
                <a href="{{ route('home') }}" class="btn btn-lg btn-primary btn-block">Voltar à página principal</a>
            </div>
        </div>

        <div class="clearfix"></div>

    </div>
</div>

@stop
