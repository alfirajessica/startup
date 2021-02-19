@extends('layouts.inv')

@section('content')
<div class="container">
    <div class="py-4"></div>
    <div class="card shadow"> <!-- card shadow -->
        <div class="card-header border-1">
            <div class="nav-wrapper">
                <!-- tabs -->
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Buka Event Baru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Lihat Daftar Event Saya</a>
                    </li>
                </ul>
                <!--end tabs -->
            </div>
        </div>
    
        <div class="card-body"> <!-- card body -->
            <!-- tab content -->
            <div class="tab-content" id="myTabContent">
                <!-- buat event -->
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="row">
                        <div class="col md-6">

                            <div class="form-group">
                                <label for="nama_event">Nama Event</label>
                                <input type="text" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
                                <small id="nama_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleTextarea">Deskripsi Event</label>
                                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="jadwal_event">Jadwal Event</label>
                                <input type="date" class="form-control" id="jadwal_event" aria-describedby="jadwal_eventHelp">
                                <small id="jadwal_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Example select</label>
                                <select class="form-control" id="exampleSelect1">
                                  <option>Online</option>
                                  <option>Offline</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="link_event">Link Event</label>
                                <input type="text" class="form-control" id="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event">
                                <small id="link_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelect1">Lokasi</label>
                                <select class="form-control" id="exampleSelect1">
                                  <option>--</option>
                                  
                                </select>
                            </div>

                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="jadwal_event">Pendaftaran dibuka</label>
                                <input type="date" class="form-control" id="jadwal_event" aria-describedby="jadwal_eventHelp">
                                <small id="jadwal_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="form-group">
                                <label for="jadwal_event">Pendaftaran Ditutup</label>
                                <input type="date" class="form-control" id="jadwal_event" aria-describedby="jadwal_eventHelp">
                                <small id="jadwal_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>

                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile04">
                                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary" type="button">Button</button>
                                </div>
                              </div>
                        </div>
                    </div>
          
                </div>
                <!-- end of buat event -->
    
                <!-- lihat daftar event -->
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <div class="row">
                        <div class="col md-6">
                            <a href="http://">ok2</a>
                        </div>
                        <div class="col md-6">
                            <a href="http://">ok2</a>
                        </div>
                    </div>
                </div> <!-- end of lihat daftar event -->
            </div> <!-- end of tab content -->
        </div> <!--end of card body -->
    </div> <!--end of card shadow -->
    
</div>
@endsection

