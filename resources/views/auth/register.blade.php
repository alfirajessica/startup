@extends('layouts.app')

@section('content')
<body class="register-page">
    <section class="section section-shaped section-lg">
        <div class="shape shape-style-1 bg-gradient-default">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="card bg-secondary shadow border-0">
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <small>Or sign up with credentials</small>
                  </div>
                  <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role Anda?</label>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary">
                                <input value="1" type="radio" name="role" id="" autocomplete="off"> Developer
                                </label>
                                <label class="btn btn-outline-primary btn-round mx-2">
                                <input value="2" type="radio" name="role" id=" " autocomplete="off "> Investor
                                </label>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                {{-- <span class="text-danger error-text role_error"></span> --}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="nama">
            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-alternative mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                       
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            
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
                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" aria-describedby="basic-addon1" placeholder="Password">

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

                    <div class="form-group focused">
                        <div class="input-group input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                      
                            <input placeholder="Password konfirmasi" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" aria-describedby="basic-addon2">
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">
                                <i class="fa fa-eye-slash" onclick="show2()" id="i_slash2" style="display:block;"></i>
                                <i class="fa fa-eye" id="i_eye2" style="display:none;" onclick="hide2()"></i>
                                </span>
                            </div>  
  
                        </div>
                    </div>

                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="row mt-3">
                        
                        <div class="col-12 text-center">
                            @if (Route::has('login'))
                            <a class="text-dark" href="{{ route('login') }}"><small>{{ __('Sudah Punya Akun? Login Disini') }}</small></a>
                            @endif
                        </div>
                        
                    </div>
                  </form>
                </div>
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

    function show2() {
        $("#password-confirm").attr("type", "text");
        $("#i_eye2").attr("style", "display:block");
        $("#i_slash2").attr("style", "display:none");
    }
      
    function hide2() {
        $("#password-confirm").attr("type", "password");
        $("#i_eye2").attr("style", "display:none");
        $("#i_slash2").attr("style", "display:block");
    }
</script>
</html>