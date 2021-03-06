@extends('head')

<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
    .navbar{
        
        background-color:#0A1931;
    }
    .dropdown-menu{
        background-color:#0a1931;
    }
    .landing-page{
        background-color: #EFEFEF;
    }
    .jumbotron {
        background-image: none
    }
    .navbar-brand-img {
    height: 80px;
    width: 100px;
    }
  </style>
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
          <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="..." >
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: #f7f3e9"></i></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ url('/home') }}">
                            <img src="/../images/Logo-Startupinow-used2.png" class="navbar-brand-img" alt="...">
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
                    <a class="nav-link text-white" href="{{ route('dev.event') }}">{{ __('Event') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('valuation') }}">{{ __('Valuation Tools') }}</a>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ route('dev.product') }}" class="dropdown-item">
                            <i class="ni ni-collection"></i>
                            <span>{{ __('Proyek Saya') }}</span>
                        </a>

                        <a href="{{ route('dev.listJoinEvent') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('Event diikuti') }}</span>
                        </a>

                        <a href="{{ route('akun') }}" class="dropdown-item">
                            <i class="ni ni-settings"></i>
                            <span>{{ __('Pengaturan Akun') }}</span>
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
    <div class="wrapper">
        
        <main >
            @yield('content')
            
        </main>
     
    </div>
    
</body>
</html>

