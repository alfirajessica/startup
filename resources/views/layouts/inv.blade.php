@extends('head')
<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
  </style>
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
                            <img src="../argon/assets/img/brand/blue.png">
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
                    <a class="nav-link" href="{{ route('inv.startup') }}">{{ __('Startup') }}</a>
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

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('inv.event') }}">
                            {{ __('Buat Event') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('inv.invest') }}">
                            {{ __('List Investasi') }}
                        </a>

                        <a class="dropdown-item" href="">
                            {{ __('Riwayat Review dan Rating') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">
                            {{ __('Laporan') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('inv.akun') }}">
                            {{ __('Pengaturan Akun') }}
                        </a>

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
  
    <!-- End Navbar -->
    <div class="wrapper">
        @if (Route::currentRouteName() == "home")
            @include('units.jumbotron')
            
        @endif

        <main  class="bg-secondary">
            @yield('content')
        </main>

        {{-- <div class="section features-6">
            <div class="container">
              <div class="row align-items-center">
                
              </div>
            </div>
          </div> --}}
        
        <br /><br />

        @include('units.footer')
    </div>

</body>
</html>

