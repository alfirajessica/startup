@extends('layouts.inv')

@section('content')
  @foreach ($akun_user as $item)
  
  
    <div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(/argon/assets/img/theme/img-1-1200x1000.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello {{$item->name}}</h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container my--6">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header text-white">
                    <div class="nav-wrapper">
                        <!-- tabs -->
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Password</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 py-2">
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card shadow border-0">
                      <div class="card-body">
                        <section class="section py-2">
                          <div class="container">
                            <div class="card card-profile border-0">
                              <div class="">

                                <div class="mt-5 text-center">
                                  <div class="text-center">
                                    <a href="#" class="btn btn-sm btn-info mr-4 float-right" data-toggle="modal" data-target="#ubahProfilModal">Ubah Profil</a>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                      <h3 name="name_user">{{$item->name}}</h3>
                                  <div class="h6 font-weight-300" name="location_user"><i class="ni location_pin mr-2"></i>{{$item->province_name}},{{$item->city_name}}</div>
                                  <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>{{$item->email}}</div>
                                 
                                    </div>
                                  </div>
                                </div>

                                <div class="mt-5 py-5 border-top text-center">
                                  <div class="text-center">
                                    <a href="#" class="btn btn-sm btn-info mr-4 float-right" data-toggle="modal" data-target="#ubahTentangModal">Atur tentang saya</a>
                                  </div>
                                  <div class="row justify-content-center">
                                    
                                    <div class="col-lg-9">
                                      <h6>Deskripsi Startup Anda</h6>
                                      <p>
                                        @if ($item->desc == null)
                                            [-]
                                        @else
                                          {{$item->desc}}
                                        @endif
                                      </p>
                                      <br>
                                      <h6>Tim Startup Anda</h6>
                                      <p>
                                        @if ($item->team == null)
                                            [-]
                                        @else
                                          {{$item->team}}
                                        @endif
                                      </p>
                                      <br>
                                      <h6>Keuntungan Startup Anda</h6>
                                      <p>
                                        @if ($item->benefit == null)
                                        [-]
                                        @else
                                          {{$item->benefit}}
                                        @endif
                                      </p>
                                      <br>
                                      <h6>Target Anda</h6>
                                      <p>
                                        @if ($item->target == null)
                                        [-]
                                        @else
                                          {{$item->target}}
                                        @endif
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  
                      <div class="row py-2">
                          <div class="col">
                            <div class="card shadow border-0">
                              <div class="card-body">
                                <form action="">
                                  <div class="form-group">
                                      <label for="nama_event">Password Anda</label>
                                      <input type="text" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" value="{{$item->password}}">
                                  </div>
  
                                  <div class="dropdown-divider"></div>
  
                                  <div class="alert alert-warning" role="alert">
                                      <strong>Peringatan</strong> Isi jika ingin mengubah password saja
                                  </div>
  
                                  <div class="form-group">
                                      <label for="nama_event">Password Baru</label>
                                      <input type="password" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
                                  </div>
  
                                  <div class="form-group">
                                      <label for="nama_event">Konfirmasi Password Baru</label>
                                      <input type="password" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
                                  </div>
  
                                  <button class="btn btn-primary" type="submit">Simpan</button>
                              </form>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div> <!-- end of lihat daftar event -->
              </div> <!-- end of tab content --> 
            </div>
        </div>
    </div>
    <br>

    @include('developer.akun.ubahProfil')
    @include('developer.akun.ubahTentang')
    @endforeach


@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>


<script>
  $(document).ready(function () {
    var idprovinsi = $('#edit_provinsi_user').val();
    var idcity = $('#city_id').val();
    open_city(idprovinsi, idcity);
  });

  function open_city(idprovince, idcity) {   
    console.log(idprovince, idcity);
   
    if (idprovince) {
        jQuery.ajax({
            url: '/cities/'+idprovince,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="edit_kota_user"]').empty();
                
                $('select[name="edit_kota_user"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(response, function (key, value) {
                    var id = value["city_id"];

                    $('select[name="edit_kota_user"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                });
                $('select[name="edit_kota_user"]').find('option[value="'+idcity+'"]').attr("selected",true);
            },
        });
    } else {
        $('select[name="edit_kota_user"]').append('<option value="">-- pilih kota --</option>');
    }
}
</script>

