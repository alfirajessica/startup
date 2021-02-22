@extends('head')
<link href="/css/blog.css" rel="stylesheet">
<body>
    <div id="app">
        <div class="container ">
            <header class="blog-header fixed-top">
                <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm px-4">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            {{ config('app.name', 'Startup') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('startup') }}">{{ __('Startup') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('valuation') }}">{{ __('Valuation Tools') }}</a>
                                </li>
                                
                            </ul>
        
                            <!-- Right Side Of Navbar -->
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
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('event') }}">
                                                {{ __('Buat Event') }}
                                            </a>

                                            <a class="dropdown-item" href="">
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
                @if (Route::currentRouteName() == "home")
                    @include('units.category')
                @endif
                @if (Route::currentRouteName() == "startup")
                    @include('units.category')
                @endif
                </header>
                
                @if (Route::currentRouteName() == "home")
                    @include('units.jumbotron')
                @endif

                @if (Route::currentRouteName() == "startup")
                    @include('units.product')
                @endif

                @if (Route::currentRouteName() == "event")
                    
                @endif
                     
        </div>

        <main class="py-4">
            
            {{-- <div class="panel-body">
                @component('components.who')
                @endcomponent
            </div> --}}

            @yield('content')
            
        </main>

        @include('units.footer')
    </div>
</body>
</html>

