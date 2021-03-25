@extends('head')
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5" href="{{ url('/home') }}">
            {{ config('app.name', 'Startup') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="../../../index.html">
                            <img src="../assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                    </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dev.event') }}">{{ __('Event') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('valuation') }}">{{ __('Valuation Tools') }}</a>
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
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('dev.product') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Produk') }}</span>
                        </a>

                        <a href="{{ route('dev.listJoinEvent') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Event diikuti') }}</span>
                        </a>

                        <a href="{{ route('dev.review') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Riwayat Review dan Rating') }}</span>
                        </a>

                        <a href="#" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Laporan') }}</span>
                        </a>

                        <a href="{{ route('dev.akun') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Pengaturan Akun') }}</span>
                        </a>

                        {{-- <a class="dropdown-item" href="{{ route('dev.product') }}">
                            {{ __('Daftarkan Produk') }}
                        </a> --}}

                        {{-- <a class="dropdown-item" href="{{ route('dev.product') }}">
                            {{ __('Produk Saya') }}
                        </a> --}}


                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('users.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  
    <!-- wrapper -->
    <div class="wrapper">
        @if (Route::currentRouteName() == "home")
            @include('units.jumbotron')
            
        @endif

        {{-- @if (Route::currentRouteName() == "dev.akun")
        <section class="section-profile-cover section-shaped my-0">
            <!-- Circles background -->
            <img class="bg-image" src="/argon/assets/img/pages/mohamed.jpg" style="width: 100%;">
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
              <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
              </svg>
            </div>
          </section>
        @endif --}}

        <main>
            @yield('content')
        </main>

        {{-- <div class="section">
            <div class="container">
              <div class="row align-items-center">
                
              </div>
            </div>
        </div> --}}
        
        <br /><br />

        @include('units.footer')
    </div>
    <!-- end wrapper -->
    @include('units.scripts')
</body>
</html>

