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


  <!--top-Header-menu-->
  {{-- <div id="user-nav" class="navbar navbar-inverse" style="margin-left:1000px">
    <ul class="nav">
      <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome User</span><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
          <li class="divider"></li>
          <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div> --}}
  <!--close-top-Header-menu-->

  <!--sidebar-menu-->
  <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Barang</a>
    <ul>
      {{-- <li><a href="/barang" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">Barang</a></li> --}}
      <li><a href="/barang"><i class="icon-folder-open"></i> <span style="font-family: sans-serif;font-size:15px">Barang</span></a> </li>
      <li> <a href="/customer"><i class="fas fa-users"></i> <span style="font-family: sans-serif;font-size:15px">Customer</span></a> </li>
      <li><a href="/supplier"><i class="fas fa-truck-moving"></i> <span style="font-family: sans-serif;font-size:15px">Supplier</span></a></li>
      <li><a href="/pembelian"><i class="icon-signin"></i> <span style="font-family: sans-serif;font-size:15px">Pengadaan</span></a></li>
    </ul>
  </div>
  <!--sidebar-menu-->

  <!--main-container-part-->
  <div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!--end-main-container-part-->

  <!--Footer-part-->

  <div class="row-fluid">
    <div id="footer" class="span12"> 2019 &copy;</div>
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
