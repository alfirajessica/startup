@extends('layouts.app')
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
@section('content')
<body class="landing-page" style="background-color: #0a1931">
    <section class="section section-shaped">
        
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 py-4">
                <img src="/images/log.svg" class="img-fluid" alt="Responsive image">
            </div>
            
                <div class="col-lg-5">
                    <div class="card bg-secondary shadow border-0">
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="card-body px-lg-5 py-lg-4">
                            <div class="text-center text-muted mb-4">
                                <img src="/images/Logo-Startupinow-used2.png" width="160" height="50" margin-top="10px" alt=""> <br>
                                <small class="text-dark">Masuk Ke StartupINow.</small>
                            </div>
                    
                            <div class="form-group mb-3 text-dark">
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
                                <label class="custom-control-label text-dark" for=" customCheckLogin"><span>{{ __('Ingat Saya') }}</span></label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-default my-2">
                                    {{ __('Login') }}
                                </button>
                                <br>
                                @if (Route::has('password.request'))
                                <a class="text-dark" href="{{ route('password.request') }}">
                                <small> {{ __('Lupa Password?') }} </small>
                            </a>
                            @endif
                            </div>
                            
                        </div>
                        <div class="row mt-3 px-lg-5 px-2">
                            
                            @if (Route::has('register'))
                            <div class="form-group px-4">
                                <a class="text-dark" href="{{ route('register') }}"><small> Belum punya akun? <u> Register Disini </u></small></a>
                            </div>
                            @endif
                           
                        </div>
                        </form>
                    </div>
                    
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


