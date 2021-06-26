@extends('head')
<style>
  .modal-body {
  max-height: calc(100vh - 210px);
  overflow-y: auto;
  }
  .ct-sidebar .nav>.active>a:before {
    position: absolute;
    top: 50%;
    left: 1.5rem;
    width: 2px;
    height: 16px;
    content: '';
    transform: translateY(-50%);
    background-color: #0099e5;
}
</style>
<body class="docs">
    <header class="navbar navbar-horizontal navbar-expand navbar-dark flex-row align-items-md-center ct-navbar" style="background-color: #0a1931">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{ config('app.name', 'Startup') }}
        </a>
        
        <div class="d-none d-sm-block ml-auto" style="background-color: #0a1931">
          <ul class="navbar-nav ml-auto">
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.categoryProduct') }}">
                            {{ __('Produk Kategori') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.akun') }}">
                            {{ __('Pengaturan Akun') }}
                        </a>

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
        <button class="navbar-toggler ct-search-docs-toggle d-block d-md-none ml-auto ml-sm-0 collapsed" type="button" data-toggle="collapse" data-target="#ct-docs-nav" aria-controls="ct-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        </header>
        <div class="container-fluid" >
          <div class="row flex-xl-nowrap">
            <div class="col-12 col-md-3 col-xl-2 ct-sidebar" style="background-color: #0a1931">
              <nav class="collapse ct-links" id="ct-docs-nav" >
                <!-- Show links for all groups -->
                <div class="ct-toc-item active">
                  <a class="ct-toc-link" href="../../docs/getting-started/overview.html">Getting started</a>
                  <ul class="nav ct-sidenav">
                    
                    <li class="ct-sidenav-active">
                      <a class="" href="dashboard.html">
                        {{-- <i class="ni ni-tv-2 text-primary"></i> --}}
                        <span class="nav-link-text">Dashboard</span>
                      </a>
                    </li>

                    <li class="ct-sidenav-active">
                      <a href="{{ route('admin.categoryProduct') }}">
                        {{-- <i class="ni ni-tv-2 text-primary"></i> --}}
                        <span class="nav-link-text">{{ __('Produk Kategori') }}</span>
                      </a>
                    </li>
                    
                    <li>
                      <a href="{{ route('admin.typeTrans') }}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">{{ __('Tipe Transaksi') }}</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- Show links for all groups -->
                <div class="ct-toc-item active">
                  <a class="ct-toc-link" href="../../docs/foundation/colors.html">Developer</a>
                  <ul class="nav ct-sidenav">
                    <li>
                      <a href="{{ route('admin.dev.produkDev')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Produk Terbaru</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.dev.allListProduct')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Produk Terdata</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.dev.listDev')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Daftar Developer</span>
                      </a>
                    </li>
                    
                  </ul>
                </div>
                <!-- Show links for all groups -->
                <div class="ct-toc-item active">
                  <a class="ct-toc-link" href="../../docs/components/avatar.html">Investor</a>
                  <ul class="nav ct-sidenav">
                    <li>
                      <a href="{{ route('admin.inv.listInv')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Daftar Investor</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('admin.inv.transaksiInv')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Transaksi</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- Show links for all groups -->
                <div class="ct-toc-item active">
                  <a class="ct-toc-link" href="../../docs/plugins/charts.html">Laporan</a>
                  <ul class="nav ct-sidenav">
                    <li>
                      <a  href="dashboard.html">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Laporan 1</span>
                      </a>
                    </li>
                      
                  </ul>
                </div>
                {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a> --}}
              </nav>
            </div>
            {{-- <div class="d-none d-xl-block col-xl-2 ct-toc">
              <ul class="section-nav">
                  <li class="toc-entry toc-h3"><a href="#examples">Examples</a></li>
                  <li class="toc-entry toc-h3"><a href="#dark-table">Dark table</a></li>
              </ul>
            </div> --}}
            
            <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 ct-content" style="background-color: #0a1931" role="main">
              @yield('content')
            </main>
          </div>
        </div>
        
</body>

</html>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
$("button").click(function(){
  $('li .ct-sidenav-active').addClass('active');
});



</script>