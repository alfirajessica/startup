@extends('layouts.dev')

@section('content')
    <div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(/argon/assets/img/theme/img-1-1200x1000.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello Jesse</h1>
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
            
            <div class="col-md-12">
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <section class="section py-2">
                      <div class="container">
                        <div class="card card-profile border-0">
                          <div class="">
                            <div class="text-center">
                              <a href="#" class="btn btn-sm btn-info mr-4 float-right">Ubah Profil</a>
                            </div>
                            <div class="text-center my-6 mb-0">
                              <h3>Jessica Jones<span class="font-weight-light">, 27</span></h3>
                              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>Bucharest, Romania</div>
                              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer</div>
                              <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
                            </div>
                            <div class="mt-5 py-5 border-top text-center">
                              <div class="text-center">
                                <a href="#" class="btn btn-sm btn-info mr-4 float-right">Atur tentang saya</a>
                              </div>
                              <div class="row justify-content-center">
                                
                                <div class="col-lg-9">
                                  <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>
                                  <a href="javascript:;">Show more</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                  
                      <div class="row py-2">
                          <div class="col">
                              <form action="">
                                  <div class="form-group">
                                      <label for="nama_event">Password Anda</label>
                                      <input type="password" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
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
                  </div> <!-- end of lihat daftar event -->
              </div> <!-- end of tab content -->
                    
            </div>
        </div>
    </div>

@endsection

