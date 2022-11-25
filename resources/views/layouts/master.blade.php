<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!--<link rel="stylesheet" href="css/estilo.css">-->
  <title>@yield('titulo')</title>

  <!-- Font Awesome Icons -->
  <script src="{{asset('js/vue.js')}}" type="text/javascript"></script>

  <link rel="stylesheet" href="css/all.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet"  href="css/estilo.css">

  <meta name="token" id="token" value="{{ csrf_token() }}">
  @stack('css')

</head>

<body class="hold-transition sidebar-mini" >
  <div class="fondo"><!--fondo-->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #92BF55">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
<!--es el texto de la cabezilla verde-->
   <h1 class="m-0 text-dark"></h1>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      <!-- Notifications Dropdown Menu -->

      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!--<a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Santa Maria</span>
    </a>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!--imagen-->
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Laura Gongora</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              vender
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vt" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vender</p>
                </a> 
              </li>
              <li class="nav-item">
                <a href="productos" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="h" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial de ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="guias" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Guias de turistas</p>
                </a>
              </li>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              Caja
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="almacen" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Almacen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="egresos" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>$CAJA</p>
                </a>
              </li>

            </ul>
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
   
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          @yield('contenido')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
</div>
</div><!--fin fondo-->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!--ESTOS 2 ESCRIPTS SON MORTALES NO LOS QUITEN O TODO DEJA DE FUNCIONAR-->
<script src="melody/vendors/js/vendor.bundle.base.js"></script>
  <script src="melody/vendors/js/vendor.bundle.addons.js"></script>
@stack('scripts')

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
