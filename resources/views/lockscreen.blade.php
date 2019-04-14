@extends('layouts.auth')

@section('content')

  <section>
      <div class="container">
          <div class="row">
              <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                <a href="/" class="text-success">
                                    <span><img src="{{ asset('simple/images/logo-provider.png') }}" alt="" height="60"></span>
                                </a>
                            </h2>
                            <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                        </div>
                        <div class="account-content">
                            <div class="text-center m-b-20">
                                <div class="m-b-20">
                                    <img src="{{ route('image', ['link' => \Auth::user()->avatar, 'avatar' => true])}}" class="rounded-circle img-thumbnail" alt="" style="height:88px;">
                                </div>

                                <p class="text-muted m-b-0 font-13 line-h-24">Informe a sua senha para acessar o Dashboard. </p>
                            </div>

                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach

                            <form class="form-horizontal" action="{{ route('post_lockscreen') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-group m-b-20">
                                    <div class="col-xs-12">
                                        <label for="password">Informe sua Senha</label>
                                        <input class="form-control" type="password" name="password" id="password" required/>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Desbloquear</button>
                                    </div>
                                </div>

                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <!-- end card-box-->


                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">Não é você? voltar <a href="{{ route('login') }}" class="text-dark m-l-5">Entrar</a></p>
                        </div>
                    </div>

                </div>

              </div>
          </div>
      </div>
  </section>

@stop

@section('adminlte_js')
    @yield('js')
@stop
