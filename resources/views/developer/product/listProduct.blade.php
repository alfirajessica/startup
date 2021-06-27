<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="confirm-tab" data-toggle="tab" href="#confirm" role="tab" aria-controls="confirm" aria-selected="false">Menunggu Konfirmasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Project Aktif</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Project Tidak Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Project memiliki Investor</a>
            </li>
            
        </ul>
        <div class="card">
            
        </div>
        <div class="tab-content py-4 bg-white" id="myTabContent">
            <div class="tab-pane fade" id="confirm" role="tabpanel" aria-labelledby="confirm-tab">
                <div class="col-md-12">
                    <div class="alert alert-warning py-2 px-2" role="alert" id="alert_konfirmasiUlang">
                        <strong>Info</strong> Mohon cek kembali data yang dimasukkan. <br>
                        Kriteria dan alasan kenapa tidak dikonfirmasi Admin
                        <ul>
                            <li>Data Tidak sesuai</li>
                            <li>Dll</li>
                        </ul>
                    </div>
                </div>
                
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct" style="width:100%" id="table_listProductConfirmYet">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Dimuat</th>
                              <th>Proyek</th>
                              <th>Detail</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="alert alert-info px-2" role="alert">
                    <strong>Project Terdaftar Aktif</strong> adalah project yang ditampilkan pada katalog Startup
                </div>
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProduct">
                      <thead>
                          <tr>
                              <th>#</th>
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
            
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProductNonAktif">
                        <thead>
                            <tr>
                                <th>#</th>
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
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProductInvestor">
                        <thead>
                            <tr>
                                <th>#</th>
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
        </div>
    </div>
</div>

@include('developer.product.detailProduct')
{{-- <script src="/js/dev/listproduct.js"></script> --}}