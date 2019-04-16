@extends('layouts.auth')

@section('content')

<div class="m-t-40 card-box">
    <div class="text-center">
        <h2 class="text-uppercase m-t-0 m-b-30">
            <a href="#" class="text-success">
                <span><img src="{{ asset('simple/images/logo-provider.png') }}" alt="" height="64"></span>
            </a>
        </h2>
        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
    </div>
    <div class="account-content">

        <div class="text-center m-b-20">
            <p class="text-muted m-b-0 line-h-24">Bem Vindo ao Gestão Provider</p>
        </div>

        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group m-b-20">
                <div class="col-xs-12">
                    <label for="emailaddress">Email ou Login</label>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" type="text" id="emailaddress" required="" placeholder="Informe as suas credenciais">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20">
                <div class="col-xs-12">
                    <a href="{{ url('password/reset') }}" class="text-muted pull-right font-14">Esqueceu sua senha?</a>
                    <label for="password">Senha</label>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" required="" id="password" placeholder="Sua Senha">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-30">
                <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox5" type="checkbox">
                        <label for="checkbox5">
                            Lembrar-me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group account-btn text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-lg btn-custom btn-block" type="submit">Entrar</button>

                </div>
            </div>

        </form>

        <div class="clearfix"></div>

    </div>
</div>

@endsection
