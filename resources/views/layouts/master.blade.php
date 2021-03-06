<!DOCTYPE html>
<html>
<header>
<script type="text/javascript">
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():null !!}
    }
</script>
</header>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
  <div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('img/logo.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('img/logo.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('img/logo.png') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/icono.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!--Personal-->
            <li class="nav-item has-treeview">
              <router-link :to="{name: 'staff'}" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Personal
                </p>
              </router-link>
            </li>
            <!--/Personal-->
            <!--Productos-->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Productos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{name: 'dashboard'}" class="nav-link">
                    <i class="nav-icon fas fa-circle-notch"></i>
                    <p>Dashboard v1</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'offers'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Ofertas
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'providers'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Proveedores
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'categories'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Categorias
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'igvs'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      IGV
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'prooftypes'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Tipos de comprobantes
                    </p>
                  </router-link>
                </li>
              </ul>
            </li>
            <!--/Productos-->
            <!--Permisos-->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-lock"></i>
                <p>
                  Autenticación
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{name: 'credentials'}" class="nav-link">
                    <i class="nav-icon fa fa-id-card"></i>
                    <p>Credenciales</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'roles'}" class="nav-link">
                    <i class="nav-icon fab fa-keycdn"></i>
                    <p>
                      Roles
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'permissions'}" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                      Permisos
                    </p>
                  </router-link>
                </li>
              </ul>
            </li>
            <!--/Permisos-->
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Mantenimiento
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{name: 'workstations'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Areas de trabajo
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'workpositions'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Puestos de trabajo
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'cities'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Ciudades
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'districts'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Distritos
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'subsidiaries'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Sucursales
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{name: 'shelves'}" class="nav-link">
                  <i class="nav-icon fas fa-circle-notch"></i>
                    <p>
                      Estantes
                    </p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off text-danger"></i>
                <p>{{ __('Logout') }}</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <router-view></router-view>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->
  <script src="{{asset('js/app.js')}}"></script>
  <script src="{{asset('js/all.min.js')}}"></script>
</body>

</html>