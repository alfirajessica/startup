@extends('layouts.dev')

@section('content')
  @foreach ($akun_user as $item)
  
  
    <div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(/images/person-using-tablet.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-black">Hello {{$item->name}}</h1>
                <p class="text-black mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container my--6 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="nav-wrapper">
                        <!-- tabs -->
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Desc</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    
                    <div class="row">
                      <div class="col">
                        <div class="card shadow border-0">
                          <div class="card-body">
                              <form action="{{ route('akun.updateAkun')}}" method="POST" enctype="multipart/form-data" id="updateAkun">
                                  @csrf
                              <div class="form-group">
                                  <label class="float-left">Email</label>
                                  <input type="email" placeholder="Regular" class="form-control form-control-alternative" name="email_akunUser" id="email_akunUser" disabled value="{{$item->email}}"/>
                              </div>
                                <div class="form-group">
                                  <label for="">Nama</label>
                                  <input type="text" class="form-control form-control-alternative" name="nama_akunUser" id="nama_akunUser" placeholder="Nama" value="{{$item->name}}"> 
                                  <span class="text-danger error-text nama_akunUser_error"></span>
                                </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="float-left">Provinsi</label>
                                          <select class="form-control form-control-alternative" name="edit_provinsi_user" id="edit_provinsi_user" onchange="show_cities2(this)">
                                              <option value="0" disabled>-- pilih provinsi --</option>
                                              @foreach($provinces as $provinsi)
                                                  <option value="{{ $provinsi['province_id'] }}" {{$provinsi['province_id'] == $item->id_province  ? 'selected' : ''}}>{{ $provinsi['province'] }}</option>
                                              @endforeach
                                          </select>
                                          <span class="text-danger error-text edit_provinsi_user_error"></span>
                                      </div>
                                  </div>
                                  <input type="hidden" name="hidden_province_name" id="hidden_province_name" >
                  
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label class="float-left">Kota</label>
                                          <input type="hidden" name="city_id" id="city_id" value="{{$item->id_city}}">
                                              <select class="form-control form-control-alternative" name="edit_kota_user" id="edit_kota_user" onchange="get_city()">
                                                <option value="0">-- pilih kota --</option>
                                              </select>
                                          <span class="text-danger error-text edit_kota_user_error"></span>
                                      </div>
                                  </div>
                                  <input type="hidden" id="hidden_city_name" name="hidden_city_name">
                              </div>
                              <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                          </form>
                          </div>
                        </div>
                      </div>
                  </div>
                       
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  
                      <div class="row">
                          <div class="col">
                            <div class="card shadow border-0">
                              <div class="card-body">
                                <form action="{{ route('akun.updateTentang')}}" method="POST" enctype="multipart/form-data" id="ubahTentang">
                                  @csrf
                                  <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea class="form-control form-control-alternative" name="desc" id="desc" rows="3" >{{$item->desc}}</textarea>
                                    <span class="text-danger error-text desc_error"></span>
                                    </div>
                        
                                  <div class="form-group">
                                    <label for="">Tim anda</label>
                                    <textarea class="form-control form-control-alternative" name="team" id="team" rows="3" >{{$item->team}}</textarea>
                                    <span class="text-danger error-text team_error"></span>
                                </div>
                        
                                  <div class="form-group">
                                    <label for="">Keuntungan</label>
                                    <textarea class="form-control form-control-alternative" name="benefit" id="benefit" rows="3" >{{$item->benefit}}</textarea>
                                    <span class="text-danger error-text benefit_error"></span>
                                </div>
                        
                                  <div class="form-group">
                                    <label for="">Target</label>
                                    <textarea class="form-control form-control-alternative" name="target" id="target" rows="3">{{$item->target}}</textarea> 
                                    <span class="text-danger error-text target_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
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
   <div class="row py-6"></div>

    @endforeach

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
    <script src="/js/dev/akun.js"></script>

@endsection

