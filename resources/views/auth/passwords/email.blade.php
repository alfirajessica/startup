@extends('layouts.app')
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
@section('content')
<div class="container">
    <div class="row justify-content-center py-4 text-dark">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ubah Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Email Anda') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-default">
                                    {{ __('Kirim Link Ubah Password') }}
                                </button>
                                <label for="">*Silakan Cek Pesan Masuk Pada Email Anda</label>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
