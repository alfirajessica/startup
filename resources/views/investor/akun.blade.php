@extends('layouts.inv')
<style>
  .scroll {
  max-height: 400px;
  overflow-y: auto;
}
</style>
@section('content')
  @foreach ($akun_user as $item)
  <div class="container">
    <div class="py-3"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills py-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link mb-2 active font-weight-bold" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" >Akun</a>
                <a class="nav-link mb-2 font-weight-bold d-none" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tentang Investor</a>
            </div>
        </div>
        <div class="col-md-9 py-2">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <div class="col">
                    <div class="card shadow border-0 text-dark">
                      <div class="card-body">
                          <form action="{{ route('akun.updateAkun')}}" method="POST" enctype="multipart/form-data" id="updateAkun">
                              @csrf
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group text-dark">
                                    <label class="float-left">Email</label>
                                    <input type="email" placeholder="Regular" class="form-control form-control-alternative" name="email_akunUser" id="email_akunUser" disabled value="{{$item->email}}"/>
                                </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group text-dark">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control form-control-alternative text-dark" name="nama_akunUser" id="nama_akunUser" placeholder="Nama" value="{{$item->name}}"> 
                                    <span class="text-danger error-text nama_akunUser_error"></span>
                                  </div>
                                </div>
                              </div>
                          
                            
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="float-left">Provinsi</label>
                                      <select class="form-control form-control-alternative text-dark" name="edit_provinsi_user" id="edit_provinsi_user" onchange="show_cities2(this)">
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
                                          <select class="form-control form-control-alternative text-dark" name="edit_kota_user" id="edit_kota_user" onchange="get_city()">
                                            <option value="0">-- pilih kota --</option>
                                          </select>
                                      <span class="text-danger error-text edit_kota_user_error"></span>
                                  </div>
                              </div>
                              <input type="hidden" id="hidden_city_name" name="hidden_city_name">
                          </div>
                          <button type="submit" class="btn btn-default float-right">Simpan Perubahan</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <div class="col">
                    <div class="card shadow border-0 text-dark">
                      <div class="card-body scroll">
                        <form action="{{ route('akun.updateTentang')}}" method="POST" enctype="multipart/form-data" id="ubahTentang">
                          @csrf
                          <div class="form-group">
                            <label for="">Deskripsikan Anda</label>
                            <textarea class="form-control form-control-alternative" name="desc" id="desc" rows="3" >{{$item->desc}}</textarea>
                            <span class="text-danger error-text desc_error"></span>
                            </div>
                
                          <div class="form-group">
                            <label for="">Siapa Saja Yang Bergabung Dalam Tim</label>
                            <textarea class="form-control form-control-alternative" name="team" id="team" rows="3" >{{$item->team}}</textarea>
                            <span class="text-danger error-text team_error"></span>
                        </div>
                
                          <div class="form-group">
                            <label for="">Kelebihan Pada Startup Anda</label>
                            <textarea class="form-control form-control-alternative" name="benefit" id="benefit" rows="3" >{{$item->benefit}}</textarea>
                            <span class="text-danger error-text benefit_error"></span>
                        </div>
                
                          <div class="form-group">
                            <label for="">Ceritakan Target Anda</label>
                            <textarea class="form-control form-control-alternative" name="target" id="target" rows="3">{{$item->target}}</textarea> 
                            <span class="text-danger error-text target_error"></span>
                        </div>
                        <button type="submit" class="btn btn-default float-right">Simpan Perubahan</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
  @endforeach

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
  <script src="/js/dev/akun.js"></script>

@endsection

