<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('simple/images/favicon.ico') }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('simple/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('simple/plugins/switchery/switchery.min.css') }}">
    <link href="{{ asset('simple/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('simple/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('simple/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('simple/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('simple/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Summernote css -->
    <link href="{{ asset('simple/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />

    <!-- App css -->
    <link href="{{ asset('simple/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('simple/css/style.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <script src="{{ asset('simple/js/modernizr.min.js') }}"></script>

</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ route('home') }}" class="logo">
                    <span>
                        <img src="{{ asset('simple/images/logo-provider.png') }}" alt="">
                    </span>
                    <i>
                        <img src="{{ asset('simple/images/logo-provider-sm.jpg') }}" alt="">
                    </i>
                </a>
            </div>

            <nav class="navbar-custom">

                <ul class="list-unstyled topbar-right-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Clear All</small></a> </span>Notification</h6>
                            </div>

                            <div class="slimscroll" style="max-height: 190px;">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-custom"><i class="mdi mdi-heart"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">13 days ago</small></p>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="{{route('user')}}" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{ route('image', ['link' => \Auth::user()->avatar, 'avatar' => true])}}" alt="" class="rounded-circle"> <span class="ml-1">{{ Auth()->user()->person->name }} <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h6 class="text-overflow m-0">Provider</h6>
                            </div>

                            <!-- item-->
                            <a href="{{route('user')}}" class="dropdown-item notify-item">
                                <i class="ti-user"></i> <span>Meu Perfil</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-settings"></i> <span>Configurações</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ti-lock"></i> <span>Bloquear Tela</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item btnLogout">
                                <i class="ti-power-off"></i> <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="user-details">
                <div class="pull-left">
                    <img src="{{ route('image', ['link' => \Auth::user()->avatar, 'avatar' => true])}}" alt="" class="thumb-md rounded-circle">
                </div>
                <div class="user-info">
                    <a href="{{route('user')}}">{{ Auth()->user()->person->name }}</a>
                    <p class="text-muted m-0">{{  Auth::user()->person->department->name ?? '' }}</p>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigation</li>
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="ti-home"></i><span> Painel Principal </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('clients.index') }}">
                            <i class="ti-user"></i> <span> Clientes </span>
                        </a>
                    </li>

                    <li>
                        <a href="ui-elements.html">
                            <i class="ti-paint-bucket"></i><span class="badge badge-custom pull-right">11</span> <span> UI Elements </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-light-bulb"></i> <span> Components </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="components-range-slider.html">Range Slider</a></li>
                            <li><a href="components-alerts.html">Alerts</a></li>
                            <li><a href="components-icons.html">Icons</a></li>
                            <li><a href="components-widgets.html">Widgets</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="typography.html">
                            <i class="ti-spray"></i> <span> Typography </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-pencil-alt"></i><span> Forms </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="forms-general.html">General Elements</a></li>
                            <li><a href="forms-advanced.html">Advanced Form</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-menu-alt"></i><span> Tables </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="tables-basic.html">Basic tables</a></li>
                            <li><a href="tables-advanced.html">Advanced tables</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="charts.html">
                            <i class="ti-pie-chart"></i><span class="badge badge-custom pull-right">5</span> <span> Charts </span>
                        </a>
                    </li>

                    <li>
                        <a href="maps.html">
                            <i class="ti-location-pin"></i> <span> Maps </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-files"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="pages-login.html">Login</a></li>
                            <li><a href="pages-register.html">Register</a></li>
                            <li><a href="pages-forget-password.html">Forget Password</a></li>
                            <li><a href="pages-lock-screen.html">Lock-screen</a></li>
                            <li><a href="pages-blank.html">Blank page</a></li>
                            <li><a href="pages-404.html">Error 404</a></li>
                            <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                            <li><a href="pages-session-expired.html">Session Expired</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-widget"></i><span> Extra Pages </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="extras-timeline.html">Timeline</a></li>
                            <li><a href="extras-invoice.html">Invoice</a></li>
                            <li><a href="extras-profile.html">Profile</a></li>
                            <li><a href="extras-calendar.html">Calendar</a></li>
                            <li><a href="extras-faqs.html">FAQs</a></li>
                            <li><a href="extras-pricing.html">Pricing</a></li>
                            <li><a href="extras-contacts.html">Contacts</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);"><i class="ti-share"></i> <span> Multi Level </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level nav" aria-expanded="false">
                            <li><a href="javascript: void(0);">Level 1.1</a></li>
                            <li><a href="javascript: void(0);" aria-expanded="false">Level 1.2 <span class="menu-arrow"></span></a>
                                <ul class="nav-third-level nav" aria-expanded="false">
                                    <li><a href="javascript: void(0);">Level 2.1</a></li>
                                    <li><a href="javascript: void(0);">Level 2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="header-title m-t-0 m-b-20">@yield('page-title', 'Link')</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="p-20">

                              @yield('content')

                            </div>
                        </div>
                    </div>

                </div> <!-- container -->


                <div class="footer">
                    <div class="pull-right hide-phone">
                        Project Completed <strong class="text-custom">57%</strong>.
                    </div>
                    <div>
                        <strong>Simple Admin</strong> - Copyright © 2017 - 2018
                    </div>
                </div>

            </div> <!-- content -->

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('simple/js/jquery.min.js') }}"></script>
    <script src="{{ asset('simple/js/popper.min.js') }}"></script>
    <script src="{{ asset('simple/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('simple/js/metisMenu.min.js') }}"></script>

    <script src="{{ asset('simple/js/waves.js') }}"></script>
    <script src="{{ asset('simple/js/jquery.slimscroll.js') }}"></script>

    <script src="{{ asset('simple/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('simple/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/i18n/pt-BR.js"></script>
    <script src="{{ asset('simple/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('simple/plugins/switchery/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('simple/plugins/parsleyjs/parsley.min.js') }}"></script>

    <script src="{{ asset('simple/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('simple/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('simple/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('simple/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('simple/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('simple/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('simple/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('simple/js/jquery.core.js') }}"></script>
    <script src="{{ asset('simple/js/jquery.app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.20.6/sweetalert2.all.min.js"></script>
  	<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCdFj8jkxW4lzvZjL7R86Smrgy9lmO5wAE&libraries=places&dummy=.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/pt-br.js"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/fullcalendar.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.0/locale/pt-br.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>



    <script>

  		$(document).ready(function() {

  			$('.select2').select2({
  				width: '100%'
  			});
/*
  		  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

  			elems.forEach(function(html) {
  			  var switchery = new Switchery(html);
  			});
*/
        $('.summernote').summernote({
          placeholder: '',
          height: 250
        });

  		});

  		$('.inputDate').mask('00/00/0000');
  	  $('.inputCep').mask('00000-000');
  		$('.inputPhone').mask('(00)00000-0000');
  	  $('.inputCpf').mask('000.000.000-00', {reverse: true});
    	$('.inputCnpj').mask('00.000.000/0000-00', {reverse: true});
  		$('.inputMoney').mask('000.000.000.000.000,00', {reverse: true});

  		$('#select-department').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {

  						var self = $(this);
  						var selectedDepartment = $("#select-department").val();

  						selectedDepartment = 'id='+ selectedDepartment;

  						$("#select-user").html("");

  						$.ajax({
  								type: 'GET',
  								url: $("#select-department").data('route'),
  								dataType: 'html',
  								data: selectedDepartment,
  								}).done( function( data ) {
  										data = JSON.parse(data);

  										data = $.map(data.data, function(item) {
  											if(item) {
  												return { item };
  											}

  										});

  										console.log(data);

  										$('#select-user').selectpicker('val', data);
  										$('#select-user').selectpicker('refresh');
  								});
  		});

  		$('.inputDate').datepicker({
  	    format: "dd/mm/yyyy",
  	    todayBtn: "linked",
  	    clearBtn: true,
  	    language: "pt-BR",
  	    daysOfWeekDisabled: "0,6",
  	    calendarWeeks: true,
  	    autoclose: true,
  	    todayHighlight: true,
  	    toggleActive: true
  		});

  	</script>

    <script>

      // Mascara de CPF e CNPJ
      var CpfCnpjMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
          },
          cpfCnpjpOptions = {
            onKeyPress: function(val, e, field, options) {
              field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
            }
          };

      $(function() {
        $(':input[name=document]').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
      })

    </script>

    @if(\Auth::user()->change_password)
        <script>
            $(function() {
              $("#editar-senha-home").modal('show');
            });
        </script>
      @endif

      @if (notify()->ready())
        <script>
            swal({
                title: "{!! notify()->message() !!}",
                text: "{!! notify()->option('text') !!}",
                type: "{{ notify()->type() }}",
                @if (notify()->option('timer'))
                    timer: {{ notify()->option('timer') }},
                    showConfirmButton: false
                @endif
            });
        </script>
    @endif

    <script>

  	$(".filestyle").filestyle({buttonText: "Escolher Arquivos", buttonName: "btn btn-primary", input: false, 'placeholder': 'My file text'});

  	$('.page-loading').removeClass('sk-loading');

  	$(".inputCep").blur(function() {

  			let route = $(this).data('cep');
  			let value = $(this).val();

  			$('.ibox-loading').children('.ibox-content').toggleClass('sk-loading');

  			if(value) {

  				$.ajax({
  					type: 'GET',
  					async: true,
  					url: route+'?search='+value,
  					success: function(response) {

  							if(!response.success) {

  								Swal.fire({
  									type: 'error',
  									title: 'Oops...',
  									text: response.message,
  								})

  							}

  							let dataResponse = response.data['response'];
  							let dataResponseCoodenadas = response.data['coordenadas'];

  							$("#street").val(dataResponse.logradouro);
  							$("#district").val(dataResponse.bairro);
  							$("#city").val(dataResponse.localidade);
  							$("#state").val(dataResponse.uf);

  							$("#long").val(dataResponseCoodenadas.lng);
  							$("#lat").val(dataResponseCoodenadas.lat);

  							$('.ibox-loading').children('.ibox-content').removeClass('sk-loading');
  					}
  				})

  			}

  		});

  		$(".btnRemoveItem").click(function(e) {
  				var self = $(this);

  				swal({
  					title: 'Remover este item?',
  					text: "Não será possível recuperá-lo!",
  					showCancelButton: true,
  					confirmButtonColor: '#3085d6',
  					cancelButtonColor: '#d33',
  					confirmButtonText: 'Sim',
  					cancelButtonText: 'Cancelar'
  					}).then((result) => {
  					if (result.value) {

  						e.preventDefault();

  						$.ajax({
  							headers: {
  							 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  							 },
  							url: self.data('route'),
  							type: 'POST',
  							dataType: 'json',
  							data: {
  								_method: 'DELETE'
  							}
  						}).done(function(data) {

  							if(data.success) {

  								self.parents('tr').hide();
  								self.parents('.cardMessageTypes').hide();

  								Swal.fire({
  								  type: 'success',
  								  title: 'Feito!',
  								  text: data.message,
  								})

  							} else {

  								Swal.fire({
  								  type: 'error',
  								  title: 'Oops...',
  								  text: data.message,
  								})

  							}

  						});
  					}
  				});
  		});

  		$('.btnLogout').click(function() {

  		    swal({
  		      title: 'Finalizar Sessão?',
  		      text: "Esta sessão será finalizada!",
  		      type: 'warning',
  		      showCancelButton: true,
  		      confirmButtonColor: '#3085d6',
  		      cancelButtonColor: '#d33',
  		      confirmButtonText: 'Sim',
  		      cancelButtonText: 'Cancelar'
  		      }).then((result) => {
  		      if (result.value) {

  		        document.getElementById('logout-form').submit();

  		        swal({
  		          title: 'Até logo!',
  		          text: 'Sua sessão será finalizada.',
  		          type: 'success',
  		          showConfirmButton: false,
  		        })
  		      }
  		    });

  		  });

  			$(".btnRedirectSoc").click(function() {

  					var loginSoc = $("#usu").val();
  					var passwordSoc = $("#senha").val();
  					var idSoc = $("#empsoc").val();

  					if(usu && loginSoc && loginSoc) {
  							$("#formularioLoginSoc").submit();
  					} else {

  						Swal.fire({
  							type: 'error',
  							title: 'Falha ao logar no SOC',
  							text: 'Informe as suas credenciais SOC no seu perfil',
  						})

  					}


  			});

  	</script>

</body>
</html>
