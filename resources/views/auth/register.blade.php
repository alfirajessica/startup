@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 py-4">
            <img src="/images/log.svg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-6 py-4">
            <div class="card-body">
                <h2 class="text-center"> Register </h2>
                <br>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
            
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" aria-describedby="basic-addon1">
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
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" aria-describedby="basic-addon2">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon2">
                                    <i class="fa fa-eye-slash" onclick="show2()" id="i_slash2" style="display:block;"></i>
                                    <i class="fa fa-eye" id="i_eye2" style="display:none;" onclick="hide2()"></i>
                                  </span>
                                </div>  
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role Anda?</label>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary">
                                <input value="1" type="radio" name="role" id="" autocomplete="off"> Developer
                                </label>
                                <label class="btn btn-outline-primary">
                                <input value="2" type="radio" name="role" id=" " autocomplete="off "> Investor
                                </label>
                                <span class="text-danger error-text role_error"></span>
                            </div>
                        </div>
                        
                    </div>
                    
                    
            
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>

                    @if (Route::has('login'))
                    <div class="form-group row">
                        <a class="col-md-8 col-form-label text-md-right" href="{{ route('login') }}">{{ __('Sudah Punya Akun? Login Disini') }}</a>
                    </div>
                    @endif
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
@endsection



