<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title-page') DASHBOARD MONITORING</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_lte/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin_lte/css/skins/_all-skins.min.css') }}">
    


    <!-- Boostrap Datatables -->
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/fixedHeader.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <!-- Plugin Bootrsap Select2 -->
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <!-- iChek plugin -->
    <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" />
    <!-- Sweetalrt plugin -->
    <link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    <!-- Morris charts -->
    
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">

    <!-- Datepicker plugin -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript">
		    var tokenCSRF   = jQuery('meta[name="csrf-token"]').attr('content');
        var url_link    = "{{ asset('/') }}";
    </script>


  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>D</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style='font-size:15px'><b>DASHBOADR </b>MONITORING</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              @include('template.admin_lte.ganti_password')
            </ul>
          </div>
        </nav>
      </header>


      <!-- Left side column. contains the sidebar -->
      @include('template.admin_lte.menu')


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('breadcrumb')
        

        <!-- Main content -->
        <section class="content">
            @yield('konten')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Datatables Bootsrap -->
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

    <!-- Plugin Select2 -->
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <!-- Plugin iCehk -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Sweetalrt plugin -->
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Datepicker plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>





    <!-- SlimScroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
    
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_lte/js/app.min.js') }}"></script>
    <script src="{{ asset('admin_lte/js/main.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="{{ asset('plugins/morris/morris.min.js') }}"></script> -->

    
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin_lte/js/demo.js') }}"></script>

    @yield('script')
  </body>
</html>
