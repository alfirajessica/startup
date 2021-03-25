@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 py-4">
            <img src="/images/log.svg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-6 py-4">
            <div class="card-body">
                <h2 class="text-center"> Admin Login </h2>
                <br>
                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="fa fa-eye-slash" onclick="show()" id="i_slash" style="display:block;"></i>
                                    <i class="fa fa-eye" id="i_eye" style="display:none;" onclick="hide()"></i>
                                  </span>
                                </div>  
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    @guest
                    {{-- @if (Route::has('login'))
                        
                            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        
                    @endif
                     --}}
                    {{-- @if (Route::has('register'))
                    <div class="form-group row">
                        <a class="col-md-8 col-form-label text-md-right" href="{{ route('register') }}">{{ __('Belum Punya Akun? Register Disini') }}</a>
                    </div>
                    @endif --}}
                @else
                    {{-- <li class="nav-item dropdown">
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
                    </li> --}}
                @endguest
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function show() {
        $("#password").attr("type", "text");
        $("#i_eye").attr("style", "display:block");
        $("#i_slash").attr("style", "display:none");
      }
      
      function hide() {
        $("#password").attr("type", "password");
        $("#i_eye").attr("style", "display:none");
        $("#i_slash").attr("style", "display:block");
      }
</script>
@endsection




@extends('layouts.app')

@section('content')
<body class="landing-page">
    <section class="section section-shaped">
        <div class="shape shape-style-1 bg-gradient-default">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          
        </div>
        <div class="container">
            <div class="row justify-content-center">
                
            
                <div class="col-lg-5">
                    <div class="card bg-secondary shadow border-0">
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Sign in</small>
                            </div>
                    
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group focused">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    {{-- <input class="form-control" placeholder="Password" type="password"> --}}

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-eye-slash" onclick="show()" id="i_slash" style="display:block;"></i>
                                            <i class="fa fa-eye" id="i_eye" style="display:none;" onclick="hide()"></i>
                                        </span>
                                    </div>  
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for=" customCheckLogin"><span>{{ __('Remember Me') }}</span></label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-2">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3 px-lg-5">
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="text-dark" href="{{ route('admin.password.request') }}">
                                        <small> {{ __('Lupa Password?') }} </small>
                                    </a>
                                @endif
                            </div>
                            
                        </div>
                        </form>
                    </div>   
                </div>

                <div class="col-lg-6 py-4">
                    <img src="/images/Work time-amico.png" class="img-fluid" alt="Responsive image">
                </div>
            
            </div>
        </div>
      </section>
    
 @include('units.scripts')
</body>

<script>
    function show() {
        $("#password").attr("type", "text");
        $("#i_eye").attr("style", "display:block");
        $("#i_slash").attr("style", "display:none");
      }
      
      function hide() {
        $("#password").attr("type", "password");
        $("#i_eye").attr("style", "display:none");
        $("#i_slash").attr("style", "display:block");
      }
</script>
</html>
