@extends('layouts.app')

@section('content')
<body class="register-page" style="background-color: #0a1931">
  <div class="container py-2" style="overflow: hidden; overflow-y: no scroll;">
    <div class="row justify-content-center">
      <div class="col-lg-8 py-2">
        <div class="card bg-secondary shadow border-0">
          
          <div class="card-body text-dark">
            <div class="text-center text-muted mb-2">
              <h3 class="font-weight-bold">Register</h3><small class="text-dark"> Sebagai (Pilih salah satu)</small>
            </div>
            <form role="form" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group row text-dark">
                  <div class="col-md-12">
                      <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                          <label class="btn btn-outline-primary">
                          <input value="1" type="radio" name="role" id="" autocomplete="off" checked="checked"> Developer
                          </label>
                          <label class="btn btn-outline-primary btn-round mx-2">
                          <input value="2" type="radio" name="role" id=" " autocomplete="off "> Investor
                          </label>
                          @error('role')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                          
                      </div>
                  </div>
                  
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group text-dark">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                      </div>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
                      
          
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group text-dark">
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
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                     
                      <select class="form-control text-dark" name="province" onchange="show_cities(this)">
                        <option class="form-control" value="0" selected>-- Pilih provinsi --</option>
                         @foreach($provinces as $provinsi)
                            <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                        @endforeach
                      </select>
                      
                    </div>
                    <input type="hidden" id="hidden_province_name" name="hidden_province_name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" id="event_kota">
                    
                    <select class="form-control" name="city" onchange="get_city()">
                         <option value="">-- Pilih kota --</option>
                    </select>
                    <span class="text-danger error-text city_error"></span>
                </div>
                <input type="hidden" id="hidden_city_name" name="hidden_city_name">
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

              <div class="row">
                <div class="col-md-12">
                  <div class="text-center">
                    <button type="submit" class="btn btn-default mt-4">
                        {{ __('Register') }}
                    </button>
                </div>
                </div>
                
              </div>
              

              <div class="row mt-3">
                  
                  <div class="col-12 text-center">
                      @if (Route::has('login'))
                      <a class="text-dark" href="{{ route('login') }}"><small>Sudah Punya Akun? <u>Login Disini</u></small></a>
                      @endif
                  </div>
                  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row"></div>

  </div>
    
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

    //show cities when province selected
    function show_nameprovince() {
        $("#hidden_province_name").val($('select[name="province"] option:selected').text());
    }

    function show_cities() {
      $("#hidden_province_name").val($('select[name="province"] option:selected').text());
      

    let provindeId = $('select[name="province"]').val();
    if (provindeId) {
        jQuery.ajax({
            url: 'reg/cities/'+provindeId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="city"]').empty();
                $('select[name="city"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(response, function (key, value) {
                    var id = value["city_id"];
                    $('select[name="city"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                });
                
            },
        });
    } else {
        $('select[name="city"]').append('<option value="">-- pilih kota --</option>');
    }
}

function get_city() {  
    $("#hidden_city_name").val($('select[name="city"] option:selected').text());
}
</script>
</html>