<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('simple/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('simple/js/modernizr.min.js') }}"></script>


</head>
<body>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        @yield('content')



                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>


    <!-- jQuery  -->
    <script src="{{ asset('simple/js/jquery.min.js') }}"></script>
    <script src="{{ asset('simple/js/popper.min.js') }}"></script>
    <script src="{{ asset('simple/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('simple/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('simple/js/waves.js') }}"></script>
    <script src="{{ asset('simple/js/jquery.slimscroll.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('simple/js/jquery.core.js') }}"></script>
    <script src="{{ asset('simple/js/jquery.app.js') }}"></script>

</body>
</html>
