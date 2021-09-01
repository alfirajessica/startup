<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
    .form-control:disabled{
        background-color:white;
    }
</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailProduct">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding-bottom: 0rem;">
            <div class="col-md-11">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active font-weight-bold" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"></i>Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 font-weight-bold" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"></i>Transaksi</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        
            <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="modal-body" style="background-color: #EFEFEF; padding-top:0.5rem;">
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                       
                            <div class="tab-pane fade show active text-dark" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                <div class="alert alert-danger d-none" role="alert" id="alert_tdkdikonfirmasi">
                                    <strong>Startup/Produk Anda Tidak Dikonfirmasi</strong> <br>
                                    Dengan Alasan : <label for="" id="cetak_reasonTdkdikonfirmasi"></label>
                                </div>

                              
                                <div class="row text-dark">
                                    <div class="col-md-6 ">
                                        <div class="">
                                            <input type="hidden" id="id_product" name="id_product">
                                            <div class="form-group mb-2">
                                            <label for="">Nama Produk</label>
                                            <input type="text" name="nama_product" id="nama_product" class="form-control form-control-alternative text-dark" disabled placeholder="" aria-describedby="helpId">
                                          
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="">Kategori/Subkategori</label>
                                                <input type="text" name="kategori_product" id="kategori_product" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="helpId" disabled>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="">Startup Tag (Label)/Subtag</label>
                                                <input type="text" name="startup_tagProduct" id="startup_tagProduct" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="helpId" disabled>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="">Link/Url</label>
                                                <input type="text" name="url_product" id="url_product" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="helpId" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                           
                                            <div class="form-group mb-2">
                                                <label class="float-left">Tanggal Perilisan Startup/Produk</label>
                                                <input type="date" name="rilis_product" id="rilis_product" class="form-control form-control-alternative text-dark" aria-describedby="helpId" disabled >
                                            </div>

                                            <img id="previewImg" class="d-block user-select-none" width="100%" height="200" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsikan Startup/Produk Anda</label>
                                            <textarea class="form-control form-control-alternative text-dark" name="desc" id="desc" rows="3" disabled></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Siapa saja yang ada didalam Tim Anda</label>
                                            <textarea class="form-control form-control-alternative text-dark" name="team" id="team" rows="3" disabled></textarea>
                                          
                                        </div>

                                        <div class="form-group">
                                            <label for="">Keunggulan Startup/Produk Anda</label>
                                            <textarea class="form-control form-control-alternative text-dark" name="reason" id="reason" rows="3" disabled></textarea>
                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="">Informasi lainnya</label>
                                            <textarea class="form-control form-control-alternative text-dark" name="benefit" id="benefit" rows="3" disabled></textarea>
                                        </div>
                                        
                                        <div class="form-group d-none">
                                            <label for="">Solusi</label>
                                            <textarea class="form-control form-control-alternative text-dark" name="solution" id="solution" rows="3" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            
                            <div class="row py-2">
                                <div class="col">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active text-dark" id="investor-tab" data-toggle="tab" href="#investor" role="tab" aria-controls="investor" aria-selected="false">Investor</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link text-dark " id="pemasukkan-tab" data-toggle="tab" href="#pemasukkan" role="tab" aria-controls="pemasukkan" aria-selected="true">Pemasukkan</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link text-dark" id="pengeluaran-tab" data-toggle="tab" href="#pengeluaran" role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                                        </li>
                                    </ul>
    
                                    <div class="tab-content py-4 bg-white" id="myTabContent">
                                        <div class="tab-pane fade show active" id="investor" role="tabpanel" aria-labelledby="investor-tab">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInv">
                                                      <thead>
                                                          <tr style="text-align: center">
                                                              <th>#</th>
                                                              <th>Investor</th>
                                                              <th>Masa berakhir</th>
                                                              <th>Jumlah</th>
                                                              <th>Status</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody></tbody>
                                                      
                                                    </table>
                                                  <!-- AKHIR TABLE -->
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="tab-pane fade" id="pemasukkan" role="tabpanel" aria-labelledby="pemasukkan-tab">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_pemasukkan">
                                                        <thead>
                                                            <tr style="text-align: center">
                                                                <th>#</th>
                                                                <th>Tanggal</th>
                                                                <th>Tipe Pemasukkan</th>
                                                                <th>Jumlah (Rp)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                        <tfoot>
                                                          <tr>
                                                              <th colspan="3" style="text-align:right; font-weight:bold">Total Pemasukkan : Rp </th>
                                                              <th style="text-align:right; font-weight:bold"></th>
                                                          </tr>
                                                      </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_pengeluaran">
                                                    <thead>
                                                        <tr style="text-align: center">
                                                            <th>#</th>
                                                            <th>Tanggal</th>
                                                            <th>Tipe Pengeluaran</th>
                                                            <th>Jumlah (Rp)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="3" style="text-align:right; font-weight:bold">Total Pengeluaran : Rp</th>
                                                            <th style="text-align:right; font-weight:bold" id="totalsemua"></th>
                                                        </tr>
                                                    </tfoot>
                                                    </table>
                                                <!-- AKHIR TABLE -->
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>    
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
