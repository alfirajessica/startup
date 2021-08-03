
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
  <title>{{ config('app.name', 'StartupINow.') }}</title>
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

  <link rel="stylesheet" href="/../assets/css/argon.css?v=1.2.0" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
 

   <style>
     .navbar-vertical.navbar-expand-xs .navbar-nav > .nav-item > .nav-link.active{
       background: #06325e;
     }
     .landing-page{
        background-color: #EFEFEF;
    }
   </style>

</head>

<body class="landing-page">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left  navbar-expand-xs" id="sidenav-main" style="background-color: #0a1931">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
          <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text ">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_kategori" href="{{ route('admin.kategoriProduk') }}" title="Produk Kategori">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Produk Kategori') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="type_trans" href="{{ route('admin.typeTrans') }}" title="Tipe Transaksi">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Tipe Transaksi') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="startup_tag" href="{{ route('admin.startupTags') }}" title="Startup Tags">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">{{ __('Startup Tags') }}</span>
              </a>
            </li>
          </ul>

          <!-- Divider -->
          <hr class="my-2">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-white">
            <span class="docs-normal">DEVELOPER</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_terbaru" href="{{ route('admin.dev.produkDev')}}" title="Produk Terbaru">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Produk Terbaru</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="produk_terdata" href="{{ route('admin.dev.allListProduct')}}" title="Produk Terdata">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Produk Terdata</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="list_dev" href="{{ route('admin.dev.listDev')}}" title="Daftar Developer">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Daftar Developer</span>
              </a>
            </li>
          </ul>

          <hr class="my-1">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-white">
            <span class="docs-normal">INVESTOR</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="list_inv" href="{{ route('admin.inv.listInv')}}" title="Daftar Investor">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Daftar Investor</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" id="list_trans" href="{{ route('admin.inv.transaksiInv')}}" title="Transaksi">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Transaksi</span>
              </a>
            </li>
          </ul>

          <hr class="my-0">
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="laporan_admin" href="{{ route('admin.report')}}" title="Laporan">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>
          </ul>

          <hr class="my-0">
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link text-white" id="pengaturan_akun" href="{{ route('admin.akun')}}" title="Pengaturan Akun">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Pengaturan Akun</span>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand" style="background-color: #0a1931">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          
          <!-- Navbar links -->

          <ul class="navbar-nav">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="fas fa-bars" style="color: #f7f3e9"></i>
                </div>
              </div>
            </li>
          </ul>

          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
                
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown" >
                  <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre=""> {{ Auth::user()->name }}
                  </a>
                  
                    <div class="dropdown-menu dropdown-menu-right">
                      {{-- <a href="{{ route('admin.akun') }}" class="dropdown-item" id="pengaturan_akun" title="Pengaturan Akun">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Pengaturan Akun') }}</span>
                      </a> --}}
                      
                      <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
    
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header" style="background-color: #0a1931">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-2">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-2">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page" id="now_path">
                    {{-- {{request()->segment(count(request()->segments()))}} -  --}}
                  </li>
                </ol>
              </nav>
            </div>
            
          </div>
          <!-- Card stats -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class=" col ">
          <main role="main">
            @yield('content')
          </main>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  {{-- <script src="/../assets/vendor/jquery/dist/jquery.min.js"></script> --}}
  <script src="/../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="/../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/../assets/js/argon.js?v=1.2.0"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script type="text/javascript"  src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  
   <!-- Sweet alert -->
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script>
    $("#dashboard").addClass('active');
    var getID = $("li").find(".active").attr('title');
    console.log(getID);
    $("#now_path").text(getID);
  </script>
</body>

</html>