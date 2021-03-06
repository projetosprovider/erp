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

    @yield('css')

    <script src="{{ asset('simple/js/modernizr.min.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
    <!-- Begin page -->
    <div id="wrapper">
      <div id="app" :user="{{ \Auth::user() }}">

        @include('layouts.partials.sidemenu')

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
                      logou em:  <strong class="text-custom">{{ \Auth::user()->lastLoginAt() ? \Auth::user()->lastLoginAt()->format('d/m/Y H:i') : '-' }}</strong>.
                      @if(\Auth::user()->lastLoginAt())
                          {{ \App\Helpers\TimesAgo::render(\Auth::user()->lastLoginAt()) ?? '' }}
                      @endif
                    </div>
                    <div>
                        <strong>Provider Saúde e Segurança do Trabalho</strong> - Direitos Reservados © {{ now()->format('Y') }}
                    </div>
                </div>

            </div> <!-- content -->

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

      </div>
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('simple/js/jquery.min.js') }}"></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

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

        $('.summernote').summernote({
          placeholder: '',
          height: 250,
          width: '100%'
        });

        $(".btnBackPreviousPage").click(function(e) {
            window.history.go(-1);
            return false;
        })

        $(".filestyle").filestyle({
          buttonText: "Escolher Arquivos",
          buttonName: "btn btn-custom",
          placeholder: 'Escola um ou mais arquivos',
        });

        var notificationsWrapper   = $('.notification-list');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('.noti-icon-badge');
        var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        var notifications          = notificationsWrapper.find('.slimscroll');

        if (notificationsCount <= 0) {
          //notificationsWrapper.hide();
        }

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('fbc40aa0ff741e4532da', {
          encrypted: true,
          cluster: 'mt1',
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('notifications');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('App\\Events\\Notifications', function(data) {
          console.log(data);
          var existingNotifications = notifications.html();
          var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
          var newNotificationHtml = `
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <div class="notify-icon bg-success"><i class="mdi mdi-account-plus"></i></div>
                <p class="notify-details">`+data.message+`<small class="text-muted">`+data.time+`</small></p>
            </a>
          `;
          notifications.html(newNotificationHtml + existingNotifications);

          notificationsCount += 1;
          notificationsCountElem.attr('data-count', notificationsCount);
          notificationsWrapper.find('.notif-count').text(notificationsCount);
          notificationsWrapper.show();
        });



  		});

  		$('.inputDate').mask('00/00/0000');
  	  $('.inputCep').mask('00000-000');
  		$('.inputPhone').mask('(00)00000-0000');
  	  $('.inputCpf').mask('000.000.000-00', {reverse: true});
    	$('.inputCnpj').mask('00.000.000/0000-00', {reverse: true});
  		$('.inputMoney').mask('000.000.000.000.000,00', {reverse: true});

      let checkboxPermissions = $(".checkboxPermissions");

      checkboxPermissions.change(function() {

        var _self = $(this);
        var isChecked = _self[0].checked;

        var route = _self.data('route-grant');

        if(isChecked !== true) {
          route = _self.data('route-revoke');
        }

        $.ajax({
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          url: route,
          type: 'POST',
          dataType: 'json',
          data: {}
        }).done(function(data) {

          if(data.success) {

            const toast = swal.mixin({
              toast: true,
              position: 'top-center',
              showConfirmButton: false,
              timer: 3000
            });

            toast({
              type: 'success',
              title: data.message
            });

          } else {

            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: data.message,
            })

          }

        });

      });

      let selectClientAddress = $(".select-client-addresses");
      let selectAddress = $("#select-address");

      selectClientAddress.change(function() {

        let self = $(this);
        let route = self.data('search-addresses');
        let value = self.val();

        $.ajax({
          type: 'GET',
          url: route + '?param=' + value,
          async: true,
          success: function(response) {

            let html = "";
            selectAddress.html("");
            selectAddress.trigger('change');

            $.each(response.data, function(idx, item) {

                let address = item.description +', '+item.street+', '+item.number+' - '+item.district+', '+item.city+' - '+item.zip;

                html += "<option value="+ item.uuid +">"+ address +"</option>";

            });

            selectAddress.append(html);
            selectAddress.trigger('change');

          }
        })

      });

      let selectClientEmployees = $(".select-client-employees");
      let selectEmployee = $("#select-employee");

      selectClientEmployees.change(function() {

        let self = $(this);
        let route = self.data('search-employees');
        let value = self.val();

        $.ajax({
          type: 'GET',
          url: route + '?param=' + value,
          async: true,
          success: function(response) {

            let html = "";
            selectEmployee.html("");
            //selectEmployee.trigger('change');

            $.each(response.data, function(idx, item) {
                let employee = item.name +' - '+item.email;
                html += "<option value="+ item.uuid +">"+ employee +"</option>";
            });

            selectEmployee.append(html);
            //selectEmployee.trigger('change');

          }
        })

      });

      let selectOccupations = $(".select-occupations");
      let occupation = $("#occupation");

      selectOccupations.change(function () {

        let self = $(this);
        let route = self.data('search-occupations');
        let value = self.val();

        $.ajax({
          type: 'GET',
          url: route + '?param=' + value,
          async: true,
          success: function(response) {

            let html = "";
            occupation.html("");
            occupation.selectpicker('refresh');

            $.each(response.data, function(idx, item) {

                html += "<option value="+ item.uuid +">"+ item.name +"</option>";

            });

            occupation.append(html);
            occupation.selectpicker('refresh');

          }
        })

      });

  		$("#select-department").change(function() {

				var self = $(this);
				var selectedDepartment = $("#select-department").select2("val");

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
										return { id: item.id, text: item.name };
									}

								});

                $('#select-user').select2({
											data: data,
								});
								$('#select-user').trigger('change');
             });
  		});

  		$('.inputDate').datepicker({
  	    format: "dd/mm/yyyy",
  	    todayBtn: "linked",
  	    clearBtn: true,
  	    language: "pt-BR",
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



  	$(".inputCep").blur(function() {

  			let route = $(this).data('cep');
  			let value = $(this).val();

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

    @yield('scripts')

</body>
</html>
