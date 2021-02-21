@extends('head')
<body>
    <div id="app">
        <div class="container ">
            <header class="blog-header fixed-top">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm px-4">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Startup') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                {{-- @if (Auth::user()->role == "1")
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('startup') }}">{{ __('Startup') }}</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('event') }}">{{ __('Event') }}</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role == "2")
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Produk</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#">Event</a>
                                </li>
                                @endif --}}
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
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
        
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                    
                </nav> 
                </header>
                @include('units.jumbotron')
                @include('units.category')
                @include('units.product')          
        </div>

        <main>         
            <div class="panel-body">
                @component('components.who')
                @endcomponent
            </div>
        </main>

        @include('units.footer')
    </div>
</body>
</html>