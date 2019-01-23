<!DOCTYPE html>
<html lang="en">
<head>
  <title>Point of Sale</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{url('css/bootstrap-responsive.min.css')}}" />
  <link rel="stylesheet" href="{{url('css/fullcalendar.css')}}"/>
  <link rel="stylesheet" href="{{url('css/matrix-style.css')}}" />
  <link rel="stylesheet" href="{{url('css/matrix-media.css')}}" />
  <link rel="stylesheet" href="{{url('font-awesome/css/font-awesome.css')}}" />
  <link rel="stylesheet" href="{{url('css/jquery.gritter.css')}}" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>

  <!--Header-part-->
  <div id="header">
    <h1><a href="dashboard.html">Matrix Admin</a></h1>
  </div>
  <!--close-Header-part-->

  <!--sidebar-menu-->
  <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Barang</a>
    <ul>
      {{-- <li><a href="/barang" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">Barang</a></li> --}}
      <li><a href="/barang"><i class="icon-briefcase"></i> <span style="font-family: sans-serif;font-size:15px">Barang</span></a> </li>
      <li><a href="/kartu_stok"><i class="icon-file"></i> <span style="font-family: sans-serif;font-size:15px">Kartu Stok</span></a> </li>
      <li class="submenu"> <a href="#"><i class="icon-user"></i> <span style="font-family: sans-serif;font-size:15px">User</span>
        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
        <ul>
          <li> <a href="/customer"><i class="fas fa-users"></i> <span style="font-family: sans-serif;font-size:15px">Customer</span></a> </li>
          <li><a href="/supplier"><i class="icon-tasks"></i> <span style="font-family: sans-serif;font-size:15px">Supplier</span></a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon-truck"></i> <span style="font-family: sans-serif;font-size:15px">Pengadaan</span>
      <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
        <ul>
          <li> <a href="/pembelian"><i class="icon-th-large"></i> <span style="font-family: sans-serif;font-size:15px">Pembelian</span></a> </li>
          <li><a href="/detail_pembelian"><i class="icon-th"></i> <span style="font-family: sans-serif;font-size:15px">Detail Pembelian</span></a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon-share"></i> <span style="font-family: sans-serif;font-size:15px">Penjualan</span>
        <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
        <ul>
          <li> <a href="/pembelian"><i class="icon-external-link"></i> <span style="font-family: sans-serif;font-size:15px">Penjualan</span></a> </li>
          <li><a href="/"><i class="icon-qrcode"></i> <span style="font-family: sans-serif;font-size:15px">Detail Penjualan</span></a></li>
        </ul>
      </li>

    </ul>
  </div>
  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb"> <a href="/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      @yield('content')
    </div>

    <!--end-main-container-part-->


    <!--Footer-part-->

    <div class="row-fluid">
      <div id="footer" class="span12"> 2019 &copy;</div>
    </div>
  </div>

  <!--end-Footer-part-->

  <script src="js/excanvas.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.ui.custom.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.flot.min.js"></script>
  <script src="js/jquery.flot.resize.min.js"></script>
  <script src="js/jquery.peity.min.js"></script>
  <script src="js/fullcalendar.min.js"></script>
  <script src="js/matrix.js"></script>
  <script src="js/matrix.dashboard.js"></script>
  <script src="js/jquery.gritter.min.js"></script>
  <script src="js/matrix.interface.js"></script>
  <script src="js/matrix.chat.js"></script>
  <script src="js/jquery.validate.js"></script>
  <script src="js/matrix.form_validation.js"></script>
  <script src="js/jquery.wizard.js"></script>
  <script src="js/jquery.uniform.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="js/matrix.popover.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/matrix.tables.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

    // if url is empty, skip the menu dividers and reset the menu selection to default
    if (newURL != "") {

      // if url is "-", it is this page -- reset the menu:
      if (newURL == "-" ) {
        resetMenu();
      }
      // else, send page to designated URL
      else {
        document.location.href = newURL;
      }
    }
  }

  // resets the menu selection upon entry to this page:
  function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
  }
</script>
</body>
</html>
