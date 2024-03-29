<div class="row">
    <div class="col-md-12">
        <h4><strong>List Semua Startup/Produk </strong></h4>
        <small class="text-dark">Silakan Pilih Tab Status Startup/Produk Dibawah Ini</small>
    </div>
</div>
<div class="row py-2">
    <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link text-dark" id="confirm-tab" data-toggle="tab" href="#confirm" role="tab" aria-controls="confirm" aria-selected="false">Menunggu Konfirmasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Produk Aktif</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Produk Tidak Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Produk Memiliki Investor</a>
            </li>
            
        </ul>
        <div class="card">
            
        </div>
        <div class="tab-content py-4 bg-white" id="myTabContent">
            <div class="tab-pane fade" id="confirm" role="tabpanel" aria-labelledby="confirm-tab">
                <div class="col-md-12">
                    
                    <div class="alert alert-default px-2" role="alert">
                        <strong>Menunggu Konfirmasi</strong> adalah Startup/Produk yang statusnya belum aktif dan butuh konfirmasi Admin
                    </div>
                  
                    <div class="alert alert-danger py-2 px-2" role="alert" id="alert_konfirmasiUlang">
                        <strong>Info</strong><br>
                        Baris Startup/Produk berwarna merah menunjukkan startup/produk tidak dikonfirmasi oleh admin. Silakan perbaiki detail data dan konfirmasi ulang pada tombol <strong>Konfirmasi Ulang</strong>
                       
                    </div>
                </div>
                
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct text-dark" style="width:100%" id="table_listProductConfirmYet">
                      <thead style="text-align:center">
                          <tr>
                              <th>#Id</th>
                              <th>Dimuat</th>
                              <th>Produk</th>
                              <th>Detail</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-md-12">
                    <div class="alert alert-default px-2" role="alert">
                        Daftar Startup/Produk dibawah ini adalah Startup/Produk yang ditampilkan pada katalog Startup
                    </div>
                </div>

                
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct text-dark" width="100%" id="table_listProduct">
                      <thead style="text-align:center">
                          <tr>
                              <th>#Id</th>
                              <th>Produk</th>
                              <th>Kategori</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct text-dark" width="100%" id="table_listProductNonAktif">
                        <thead style="text-align:center">
                            <tr>
                                <th>#Id</th>
                                <th>Proyek</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    <!-- AKHIR TABLE -->
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-md-12">
                    <div class="alert alert-default px-2" role="alert">
                        Daftar Startup/Produk dibawah ini adalah Startup/Produk yang memiliki investor
                    </div>
                </div>

                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct text-dark" width="100%" id="table_listProductInvestor">
                        <thead style="text-align:center">
                            <tr>
                                <th>#Id</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    <!-- AKHIR TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('developer.product.detailProduct')