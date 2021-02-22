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
