@extends('layouts.inv')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            
            <div class="col-md-4">
                <div class="card-body border-1"> <!-- card-body -->
                    <div class="nav-wrapper"> <!-- nav-wrapper -->
                        <!-- tabs -->
                        <ul class="nav nav-pills nav-fill flex-column flex-md-column" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Password</a>
                            </li>
                        </ul>
                        <!--end of tabs -->
                    </div> <!-- end of nav-wrapper -->
                </div><!-- card-body --> 
            </div><!--end tabs -->
            
            <div class="col-md-8">
                <div class="card shadow py-4"> 
                    <div class="card-body"> <!-- card body -->
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- profile -->
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="row">
                                <div class="col">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="nama_event">Email</label>
                                            <input type="text" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" >
                                        </div>


                                        <div class="form-group">
                                            <label for="nama_event">Nama</label>
                                            <input type="text" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
                                            <small id="nama_eventHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>

                                        <div class="dropdown-divider"></div>
            
                                        <div class="form-group">
                                            <label for="exampleTextarea">Deskripsi Investor</label>
                                            <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                          <label for="">Kontak yang dapat dihubungi selain email</label>
                                          <input type="number" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                          
                                        </div>

                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                  
                        </div>
                        <!-- end of profile -->
            
                        <!-- password -->
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="row">
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
                </div> <!--end of card body -->
        
            </div>
        </div> <!-- end row --> 
    
    </div> <!--end of card shadow -->
    
</div>
@endsection

