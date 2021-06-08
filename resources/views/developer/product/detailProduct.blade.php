
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailProduct">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <div class="col-md-11">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Review</a>
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
        <div class="modal-body bg-secondary">
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                       
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <form action="{{ route('dev.listProduct.updDetailProject')}}" method="POST" id="updDetailProject">
                                    @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <input type="hidden" id="id_product" name="id_product">
                                            <div class="form-group">
                                            <label for="">Nama Produk</label>
                                            <input type="text" name="nama_product" id="nama_product" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                                            <span class="text-danger error-text nama_product_error" id="nama_product_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Jenis Produk</label>
                                                <select class="form-control form-control-alternative" name="edit_jenis_produk" id="edit_jenis_produk" onchange="show_detail_kategori(this)"> 
                                                </select>      
                                                <span class="text-danger error-text edit_jenis_produk_error" id="edit_jenis_produk_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Dalam Kategori</label>
                                                <select class="form-control form-control-alternative" name="edit_detail_kategori" id="edit_detail_kategori">    
                                                </select>
                                                <span class="text-danger error-text edit_detail_kategori_error" id="edit_detail_kategori_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Domain Produk</label>
                                                <input type="url" name="url_product" id="url_product" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                                                <span class="text-danger error-text url_product_error" id="url_product_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="float-left">Tanggal Perilisan produk</label>
                                                <input type="date" name="rilis_product" id="rilis_product" class="form-control form-control-alternative" aria-describedby="helpId" >
                                                <span class="text-danger error-text rilis_product_error" id="rilis_product_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="exampleInputFile">File input</label>
                                                    <input type="file" class="form-control-file"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
                                                    <span class="text-danger error-text image_error"></span>
                                                </div>
                                            </div>

                                            <img id="previewImg" class="d-block user-select-none" width="100%" height="200" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea class="form-control form-control-alternative" name="desc" id="desc" rows="3"></textarea>
                                            <span class="text-danger error-text desc_error" id="desc_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Tim</label>
                                            <textarea class="form-control form-control-alternative" name="team" id="team" rows="3"></textarea>
                                            <span class="text-danger error-text team_error" id="team_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Alasan</label>
                                            <textarea class="form-control form-control-alternative" name="reason" id="reason" rows="3"></textarea>
                                            <span class="text-danger error-text reason_error" id="reason_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Kegunaan</label>
                                            <textarea class="form-control form-control-alternative" name="benefit" id="benefit" rows="3"></textarea>
                                            <span class="text-danger error-text benefit_error" id="benefit_error"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Solusi</label>
                                            <textarea class="form-control form-control-alternative" name="solution" id="solution" rows="3"></textarea>
                                            <span class="text-danger error-text solution_error" id="solution_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-md-12">
                                        <button type="submit" class="next btn btn-primary float-right"> Simpan Perubahan </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        

                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                           
                            <div class="row py-2">
                                <div class="card col-md-12">
                                    <h5 class="fs-title">Investor</h5>
                                    <div class="col-md-12 py-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm" width="100%" id="table_listInv">
                                              <thead>
                                                  <tr>
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
                            </div>

                            <div class="row py-2">
                                <div class="card col-md-12">
                                    <h5 class="fs-title">Pemasukkan</h5>
                                    <div class="col-md-12 py-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm" width="100%" id="table_pemasukkan">
                                              <thead>
                                                  <tr>
                                                      <th>#</th>
                                                      <th>Tanggal</th>
                                                      <th>Tipe Pemasukkan</th>
                                                      <th>Jumlah</th>
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                              <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align:right; font-weight:bold">Total Pemasukkan :</th>
                                                    <th style="font-weight:bold"></th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                          <!-- AKHIR TABLE -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row py-4">
                                <div class="card col-md-12">
                                    <h5 class="fs-title">Pengeluaran</h5>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" width="100%" id="table_pengeluaran">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Tipe Pengeluaran</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align:right; font-weight:bold">Total Pengeluaran :</th>
                                                    <th style="font-weight:bold" id="totalsemua"></th>
                                                </tr>
                                            </tfoot>
                                            </table>
                                        <!-- AKHIR TABLE -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <div class="row py-2">
                                <div class="card col-md-12">
                                    <h5 class="fs-title">Rating & Reviews</h5>
                                    <div class="col-md-12 py-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm" width="100%" id="table_listReviews">
                                              <thead>
                                                  <tr>
                                                      <th>#</th>
                                                      <th>Tanggal</th>
                                                      <th>Investor</th>
                                                      <th>Rating & Review</th>
                                                    
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
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
