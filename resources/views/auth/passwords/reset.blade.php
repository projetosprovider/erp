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
            <p class="text-muted m-b-0 line-h-24">Recuperação de Senha</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group m-b-20">
                <div class="col-xs-12">
                    <label for="emailaddress">Email</label>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" id="email" required=""
                     placeholder="Informe seu email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20">
                <div class="col-xs-12">
                    <label for="password">Senha</label>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" id="password" required=""
                     placeholder="Informe um Senha">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group m-b-20">
                <div class="col-xs-12">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" type="password" id="password_confirmation" required=""
                     placeholder="Confirmar Senha">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group account-btn text-center m-t-10">
                <div class="col-xs-12">
                    <button class="btn btn-lg btn-custom btn-block" type="submit">{{ __('Enviar') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-lg btn-link btn-block text-muted font-14">Ir para o Login</a>
                </div>
            </div>

        </form>

        <div class="clearfix"></div>

    </div>
</div>

@endsection
