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
                    <span class="badge badge-danger badge-pill noti-icon-badge"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h6 class="m-0"><span class="float-right"><a href="" class="text-dark"><small>Limpar todos</small></a> </span>Notificações</h6>
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
                    <a href="{{ route('lockscreen') }}" class="dropdown-item notify-item">
                        <i class="ti-lock"></i> <span>Bloquear Tela</span>
                    </a>

                    @php

                      $manager = app('impersonate');

                    @endphp

                    @if($manager->isImpersonating())
                      <a href="{{ route('impersonate.leave') }}" class="dropdown-item notify-item">
                          <i class="ti-power-off"></i> <span>Sair deste Usuário</span>
                      </a>
                    @endif

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
                <form role="search" class="" action="{{ route('clients.index') }}" method="get">
                    <input type="text" placeholder="Pesquisar..." name="search" class="form-control">
                    <a><i class="fa fa-search"></i></a>
                    <button style="display:none"></button>
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
            <li class="menu-title">Navegação</li>
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

            @permission('view.treinamentos')

              <li>
                  <a href="javascript: void(0);"><i class="mdi mdi-worker"></i> <span> Treinamentos </span> <span class="menu-arrow"></span></a>
                  <ul class="nav-second-level" aria-expanded="false">

                    @permission('view.cursos')

                      <li>
                          <a href="{{route('courses.index')}}" ><i class="fa fa-book"></i> <span class="nav-label">Cursos</span> </a>
                      </li>

                    @endpermission

                    @permission('view.turmas')

                      <li>
                          <a href="{{route('teams.index')}}" ><i class="fa fa-users"></i> <span class="nav-label">Turmas</span> </a>
                      </li>

                    @endpermission

                    @permission('view.agenda')

                      <li>
                          <a href="{{route('teams.index')}}" ><i class="fa fa-calendar"></i> <span class="nav-label">Agenda</span> </a>
                      </li>

                    @endpermission

                  </ul>
              </li>

            @endpermission

            @permission('view.gestao.de.entregas')

              <li>
                  <a href="javascript: void(0);"><i class="ti-truck"></i> <span> Gestão de Entregas </span> <span class="menu-arrow"></span></a>
                  <ul class="nav-second-level" aria-expanded="false">

                    @permission('view.documentos')

                      <li>
                          <a href="{{route('documents.index')}}" > <span class="nav-label">Documentos</span> </a>
                      </li>

                    @endpermission

                    @permission('view.ordem.entrega')

                      <li>
                          <a href="{{route('delivery-order.index')}}" ><span class="nav-label">Entregas</span> </a>
                      </li>

                    @endpermission

                    <li>
                        <a href="{{route('types.index')}}"><span class="nav-label">Tipos de Documentos</span></a>
                    </li>

                  </ul>
              </li>

            @endpermission

            @permission('view.mural.de.recados')

              <li>
                  <a href="javascript: void(0);"><i class="ti-announcement"></i> <span> Mural de Recados </span> <span class="menu-arrow"></span></a>
                  <ul class="nav-second-level" aria-expanded="false">
                    @permission('view.mural')

                      <li>
                          <a href="{{route('message-board.index')}}" ><i class="ti-comments"></i> <span class="nav-label">Mural</span> </a>
                      </li>

                    @endpermission

                    @permission('view.tipos.de.recados')

                      <li>
                          <a href="{{route('message-types.index')}}" ><i class="fa fa-archive"></i> <span class="nav-label">Tipos</span> </a>
                      </li>

                    @endpermission
                  </ul>
              </li>

            @endpermission

            @permission('view.administrativo')

              <li>
                  <a href="javascript: void(0);"><i class="ti-panel"></i> <span> Administrativo </span> <span class="menu-arrow"></span></a>
                  <ul class="nav-second-level" aria-expanded="false">

                    @permission('view.departamentos')
                    <li>
                        <a href="{{route('departments')}}"><span class="nav-label">Departamentos</span></a>
                    </li>
                    @endpermission

                    @permission('view.cargos')
                    <li>
                        <a href="{{route('occupations.index')}}"><span class="nav-label">Cargos</span></a>
                    </li>
                    @endpermission

                    @permission('view.usuarios')
                    <li>
                        <a href="{{route('users')}}"><span class="nav-label">Usuarios</span></a>
                    </li>
                    @endpermission

                    @permission('view.privilegios')
                    <li>
                        <a href="{{route('roles.index')}}" ><span class="nav-label">Privilégios</span></a>
                    </li>
                    @endpermission



                  </ul>
              </li>

            @endpermission


            <!--

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

          -->

        </ul>

    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

</div>
<!-- Left Sidebar End -->
