@extends('layouts.app')

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
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                        <div class="card-body px-lg-5 py-lg-5">
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
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
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


