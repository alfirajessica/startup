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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
@endsection



