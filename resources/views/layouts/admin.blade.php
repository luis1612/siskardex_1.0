<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Kardex</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tableexport.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/magnifier.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <script src="tableToExcel.js"></script>
    <script src="FileSaver.js"></script>
    <script src="tableexport.js"></script>
    @stack('styles')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('ventas/venta')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b>KDX</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema Kardex</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('imagenes/avatar.png')}}" class="user-image" alt="User Image">
                  <small class="bg-olive">Conectado</small>
                  <i class=""></i>{{Auth::user()->name}}<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                 <!-- The user image in the menu -->
                  <li class="user-header">
                      <img src="{{asset('imagenes/avatar.png')}}" class="img-circle" alt="User Image">

                      <p>
                          <i class=""></i>{{Auth::user()->name}}<b class=" "></b>
                          <small>  Encargado de control de abastecimientos e inventario</small>
                      </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{ url('/home') }}"><i class="fa fa-btn fa-sign-in"></i>  Inicio</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ url('/logout') }}"><i class="fa fa-unlock-alt"></i>  Cerrar Sesión</a>

                    </div>
                </li>
                </ul>
              </li>
              <li>
                  <a href="#" data-toggle="control-sidebar" class="bg-teal"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
              <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{asset('imagenes/avatar.png')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{Auth::user()->name}}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Conectado </a>
                    </div>
                </div>
                <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>  -->


          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i>
                <span>Almacenes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-tags" aria-hidden="true"></i> Artículos</a></li>
                <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-cubes" aria-hidden="true"></i> Categorías</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck" aria-hidden="true"></i>
                <span>Entradas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresos</a></li>
                <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-clone"></i> Proveedores</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-check-circle-o"></i>
                <span>Salidas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ventas/venta')}}"><i class="fa fa-check-square-o"></i> Salidas</a></li>
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-users"></i> Asesor(a) </a></li>
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop" aria-hidden="true"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-folder"></i> Usuarios</a></li>
                
              </ul>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">KARDEX</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Kardex Central Grupo Ferretero</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; <script>
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var f=new Date();
                document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                </script> 
          <a href="https://github.com/luis1612" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> Luis Ibarguen</a>.
        </strong> Todos los derechos reservados.
      </footer>


         <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Numeros Telefonicos Almacenes</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                              <i class="menu-icon fa fa-phone-square bg-red"></i>
                              <div class="menu-info">
                                  <h4 class="control-sidebar-subheading">Números Telefonicos Almacenes - Bodega</h4>

                                  <p>
                                    <script>
                              var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                              var f=new Date();
                              document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                              </script>
                                   </p>
                              </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->

                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:;">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="pull-right-container">
                      <span class="label label-success pull-right">70%</span>
                    </span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.control-sidebar-menu -->
                    <form name="calc"> 
                    <input type="Text" name="operando1" value="0" size="12"> 
                    <br> 
                    <input type="Text" name="operando2" value="0" size="12"> 
                    <br> 
                    <input type="Button" name="" value=" + " onclick="calcula('+')"> 
                    <input type="Button" name="" value=" - " onclick="calcula('-')"> 
                    <input type="Button" name="" value=" X " onclick="calcula('*')"> 
                    <input type="Button" name="" value=" / " onclick="calcula('/')"> 
                    <br> 
                    <input type="Text" name="resultado" value="0" size="12"> 
                    </form>
                    <script> 
                      function calcula(operacion){ 
                          var operando1 = document.calc.operando1.value 
                          var operando2 = document.calc.operando2.value 
                          var result = eval(operando1 + operacion + operando2) 
                          document.calc.resultado.value = result 
                      } 
                    </script>
                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                <!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>


      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('js/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/tableexport.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/tableToExcel.js')}}"></script> <!-- Exportar Excel -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <script>
        $(document).ready(function() {
              responsive: true
        $('#testTable').DataTable( {
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ]
              } );
          } );
    </script>
    <script>
        $(document).ready(function() {
              responsive: true
        $('#ttTable').DataTable( {
                  dom: 'Bfrtip',
                  buttons: [
                      'copy', 'csv', 'excel', 'pdf', 'print'
                  ]
              } );
          } );
    </script>
  </body>
</html>