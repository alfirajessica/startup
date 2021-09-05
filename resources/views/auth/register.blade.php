@extends('layouts.app')
<link rel="stylesheet" href="/css/multisteps.css">
<style>
  section{
      padding-top: :100px;
  }
  .form-section{
      padding-left: 15px;
      display: none;
  }
  .form-section.current{
      display: inherit;

  }
  .btn-info, btn-btn-success{
      margin-top: 10px;
  }
  .parsley-errors-list{
      margin: 2px 0 3px;
      padding: 0;
      list-style-type: none;
      color: red;
      text-align: left;
      font-size: small;
  }
 
  .text-danger{
      font-size: 8pt;
  }
  
</style>
<link rel = "icon" href="/../images/icon-startupinow.png" type="image/png">
@section('content')
<body  class="register-page"  style="background-color: #0a1931">
  <div class="container">
    <div class="py-3"></div>
    <div class="row">
      <div class="card-body text-dark" style="padding-top: inherit;padding-bottom: inherit; ">
        <div class="text-center text-muted mb-2">
          <img src="/images/Logo-Startupinow-used.png" width="160" height="50" margin-top="10px" alt=""> <br>
          <small class="text-white"> Daftarkan Akun Anda</small>
        </div>
      </div>
    </div>
      <div class="col-md-12">
        <form id="msform" action="{{ route('register') }}" method="POST" class="contact-form" novalidate>
          @csrf
          <ul id="progressbar" class="d-flex justify-content-center" style="margin-bottom: revert;">
              <li class="active" id="account"><strong class="text-white">Peran</strong></li>
              <li class="" id="personal"><strong class="text-white">Akun</strong></li>
          </ul>

          <div class="card" style="background-color: #0a1931">
    
            <div class="row text-dark">
              
              <div class="col-md-12 mx-0">
               
                <div class="form-section text-dark">
                  <label class="text-white">Anda Akan mendaftar sebagai (Pilih Salah Satu)</label>
                  <div class="form-group text-dark">
                    
                      <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        
                         
                            <label class="btn btn-outline-secondary text-primary" style="text-align: justify; text-transform:capitalize;">
                            <input value="1" type="radio" name="role" id="" autocomplete="off" checked="checked"> <strong>DEVELOPER</strong>  <br> <br>
                            <label>  Listing Startup atau Produk Milik Startup Anda</label>
                          
                          </label>
                          
                       
                    
                            <label class="btn btn-outline-secondary text-primary mx-2" style="text-align: justify; text-transform:capitalize">
                            <input value="2" type="radio" name="role" id=" " autocomplete="off "><strong></strong> INVESTOR <br> <br>
                            Beri Investasi dan Jadilah Angel Investor
                          </label>
                         
                       
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                  </div>
                </div>
      
                <div class="form-section">
                  <div class="card-body text-dark" style="padding-top: 0rem; ">
                    <div class="text-center text-muted mb-2">
                      <div class="row row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group text-dark" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative  mb-2">
                              
                              <input id="name_company" type="text" class="form-control form-control-alternative @error('name_company') is-invalid @enderror" name="name_company" value="{{ old('name_company') }}" required autocomplete="name_company" autofocus placeholder="Nama Perusahaan Anda" data-parsley-error-message="Masukkan Nama Perusahaan Anda">
                                  @error('name_company')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group text-dark" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative mb-2">
                              
                              <input id="name" type="text" class="form-control form-control-alternative @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Akun" data-parsley-error-message="Masukkan Nama Akun">
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>
                          </div>
                        </div>
        
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-8">
                          <div class="form-group text-dark" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative mb-2">
                              
                              <input id="email" type="email" class="form-control form-control-alternative @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" data-parsley-error-message="Masukkan Email Anda">
                  
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
        
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group text-dark" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative mb-2">
                              
                              <select class="form-control form-control-alternative text-dark" name="province" onchange="show_cities(this)" required data-parsley-error-message="Pilih Provinsi Asal">
                                <option class="form-control" value="0">-- Pilih Provinsi --</option>
                                 @foreach($provinces as $provinsi)
                                    <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                                @endforeach
                              </select>
                              
                            </div>
                            <input type="hidden" id="hidden_province_name" name="hidden_province_name">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group text-dark" id="event_kota" style="margin-bottom: auto">
                            
                            <select class="form-control form-control-alternative text-dark" name="city" onchange="get_city()" required data-parsley-error-message="Pilih Kota Asal">
                                 <option value="">-- Pilih kota --</option>
                            </select>
                            <span class="text-danger error-text city_error"></span>
                        </div>
                        <input type="hidden" id="hidden_city_name" name="hidden_city_name">
                        </div>
                      </div>

                    
                      <div class="row justify-content-center">
                        <div class="col-md-4">
                          <div class="form-group focused" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative mb-2">
                              
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" aria-describedby="basic-addon1" placeholder="Password" data-parsley-error-message="Masukkan Password">

                           
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <span class="text-danger error-text password_error"></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group focused" style="margin-bottom: auto">
                            <div class="input-group input-group-alternative mb-2">
                              
                              <input placeholder="Password konfirmasi" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" aria-describedby="basic-addon2" data-parsley-error-message="Masukkan Konfirmasi Password">
                            
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="custom-control custom-control-alternative custom-checkbox mb-1">
                            <input class="custom-control-input" id="check_pass" type="checkbox" onchange="show()">
                            <label class="custom-control-label" for="check_pass">Lihat Password</label>
                          </div>
                        </div>
                       
                      </div>
                    </div>


                  </div>
                </div>
      
      
                <div class="form-navigation">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <button type="button" class="previous btn btn-outline-warning float-left text-white" >Sebelumnya</button>
          
                      <button type="button" class="next btn btn-outline-default float-right text-white"> Selanjutnya </button>
              
                      <button type="submit" class="btn btn-outline-default float-right text-white" >{{ __('Daftar Akun') }}</button>
                    </div>
                   
                  </div>
                  
              </div>
              </div>
            </div>
            <div class="row mt-3">
                  
              <div class="col-12 text-center">
                  @if (Route::has('login'))
                  <a class="text-white" href="{{ route('login') }}"><small>Sudah Punya Akun? <u>Login Disini</u></small></a>
                  @endif
              </div>
              
          </div>
          </div>
      </div>
      
    </form>
    </div>
  </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
   
    
    function show() {
      if($('#check_pass').prop('checked'))
      { 
        $("#password").attr("type", "text"); 
        $("#password-confirm").attr("type", "text");
      }
      else{
        $("#password").attr("type", "password");
        $("#password-confirm").attr("type", "password");
      }
        
    }
      
    /*function hide() {
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
    }*/

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
                $('select[name="city"]').append('<option value="0" selected>-- Pilih Kota --</option>');
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
$(function(){
        var $section = $('.form-section');

        function navigateTo(index){
            $section.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index>0);

            var atTheEnd = index >= $section.length -1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {  
            return $section.index($section.filter('.current'));

        }

        $('.form-navigation .previous').click(function(){
            navigateTo(curIndex()-1);
            $("#progressbar li").eq($(".form-section").index(curIndex()-1)).removeClass("active"); 
        });

       
        $('.form-navigation .next').click(function(e){
            
            $('.contact-form').parsley().whenValidate({
                group:'block-' + curIndex()
                //$(".parsley-required").text('ok');
     
            }).done(function(){
                navigateTo(curIndex()+1);
                $("#progressbar li").eq($(".form-section").index(curIndex()+1)).addClass("active"); 
     
            })
            
        });

         $section.each(function(index, section){
             $(section).find(':input').attr('data-parsley-group','block-'+index);
         });

        navigateTo(0);

        
    });

    /*$('#msform').submit(function (e) { 
        e.preventDefault();
          $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function() {
                $(document).find('span.error-text').text('');
            },
            success:function(data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else{
                //update yang di page akun depan
                    $('#msform')[0].reset();
                    
                    //navigateTo(0);
                    swal("Berhasil Menyimpan Startup/Produk Anda, Silakan Atur Kas Masuk dan Keluar Pada Tab yang Disediakan", {
                        icon: "success",
                    });
                  
                }
            }
        });
    });*/
</script>
</html>
@endsection