
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailProduct">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding: 0.5rem">
            
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
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 font-weight-bold" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Ulasan</a>
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
        <div class="modal-body" style="background-color: #EFEFEF;padding-top: 0.5rem;">
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                       
                            <div class="tab-pane fade show active text-dark" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                <div class="alert alert-danger d-none" role="alert" id="alert_tdkdikonfirmasi" style="
                                padding-top: 0.5rem;
                                padding-bottom: 0rem;">
                                    <strong>Startup/Produk Anda Tidak Dikonfirmasi</strong> <br>
                                    Dengan Alasan : <label for="" id="cetak_reasonTdkdikonfirmasi"></label>
                                </div>

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
                                                <label class="float-left">Kategori</label>
                                                <select class="form-control form-control-alternative" name="edit_jenis_produk" id="edit_jenis_produk" onchange="show_detail_kategori(this)"> 
                                                </select>      
                                                <span class="text-danger error-text edit_jenis_produk_error" id="edit_jenis_produk_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Subkategori</label>
                                                <select class="form-control form-control-alternative" name="edit_detail_kategori" id="edit_detail_kategori">    
                                                </select>
                                                <span class="text-danger error-text edit_detail_kategori_error" id="edit_detail_kategori_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Startup Tag (Label)</label>
                                                <select class="form-control form-control-alternative" name="edit_startup_tag" id="edit_startup_tag" onchange="show_sub_startup_tag(this)"> 
                                                    @foreach($list_hStartupTag as $hStartupTag)
                                                <option value="{{$hStartupTag->id}}"> {{$hStartupTag->name_startup_tag}}</option>
                                                @endforeach
                                                </select>      
                                                <span class="text-danger error-text edit_startup_tag_error" id="edit_startup_tag_error"></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="float-left">Sub Tag (Sublabel)</label>
                                                <select class="form-control form-control-alternative" name="edit_subStartup_tag" id="edit_subStartup_tag">    
                                                </select>
                                                <span class="text-danger error-text edit_subStartup_tag_error" id="eedit_subStartup_tag_error"></span>
                                            </div>

                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <div class="form-group">
                                                <label class="float-left">Link/Url Produk</label>
                                                <input type="url" name="url_product" id="url_product" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                                                <span class="text-danger error-text url_product_error" id="url_product_error"></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="float-left">Tanggal Perilisan produk</label>
                                                <input type="date" name="rilis_product" id="rilis_product" class="form-control form-control-alternative" aria-describedby="helpId" >
                                                <span class="text-danger error-text rilis_product_error" id="rilis_product_error"></span>
                                            </div>

                                            <div class="form-group">
                                              
                                                    <label for="exampleInputFile2">Banner/Gambar Pendukung Startup</label>
                                                    <input type="file" class="form-control-file form-control-alternative"  name="image" id="exampleInputFile2" aria-describedby="fileHelp" onchange="previewFile2(this)">
                                                    <span class="text-danger error-text image_error"></span>
                                                
                                            </div>

                                            <img id="previewImg" class="d-block user-select-none" width="100%" height="200">

                                            {{-- <img id="previewImg" class="d-block user-select-none" width="100%" height="200" > --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Deskripsikan Startup/Produk Anda</label>
                                            <textarea class="form-control form-control-alternative" name="desc" id="desc" rows="2"></textarea>
                                            <span class="text-danger error-text desc_error" id="desc_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Siapa saja yang ada didalam Tim Anda</label>
                                            <textarea class="form-control form-control-alternative" name="team" id="team" rows="2"></textarea>
                                            <span class="text-danger error-text team_error" id="team_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Keunggulan Startup/Produk Anda</label>
                                            <textarea class="form-control form-control-alternative" name="reason" id="reason" rows="2"></textarea>
                                            <span class="text-danger error-text reason_error" id="reason_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Informasi lainnya</label>
                                            <textarea class="form-control form-control-alternative" name="benefit" id="benefit" rows="2"></textarea>
                                            <span class="text-danger error-text benefit_error" id="benefit_error"></span>
                                        </div>
                                        
                                        <div class="form-group d-none">
                                            <label for="">Solusi</label>
                                            <textarea class="form-control form-control-alternative" name="solution" id="solution" rows="3"></textarea>
                                            <span class="text-danger error-text solution_error" id="solution_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <label>Proposal Startup Anda (Apabila ada)</label>
                                                <input type="file" class="form-control-file form-control-alternative"  name="proposal_startup2" id="proposal_startup2" aria-describedby="fileHelp">
                                                <span class="text-danger error-text proposal_startup2_error"></span>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label id="proposal_before"></label> <br>
                                        <a type="button" id="proposal_before2" class="btn btn-outline-primary btn-sm" style="text-transform: capitalize;" href="" target="_blank">Unduh</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <label>Kontak Kerjasama Startup Anda (Apabila ada)</label>
                                                <input type="file" class="form-control-file form-control-alternative"  name="kontrak_startup2" id="kontrak_startup2"  aria-describedby="fileHelp">
                                                <span class="text-danger error-text kontrak_startup2_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label id="kontrak_before"></label> <br>
                                        <a type="button" id="kontrak_before2" class="btn btn-outline-primary btn-sm" href="" style="text-transform: capitalize;" target="_blank">Unduh</a>
                                    </div>
                                </div>
                                <div class="row py-2" id="submit_updDetail">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-default float-right" > Simpan Perubahan </button>
                                    </div>
                                </div>
                                </form>
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
                                                      <thead style="text-align:center">
                                                          <tr>
                                                              <th>#Id</th>
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
                                                        <thead style="text-align:center">
                                                            <tr>
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
                                                    <thead style="text-align:center">
                                                        <tr>
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

                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <div class="row py-2">
                                <div class="card col-md-12">
                                    <div class="col-md-12 py-2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listReviews">
                                              <thead style="text-align:center">
                                                  <tr>
                                                      <th>#Id</th>
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

<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script>
    function previewFile2() {
        var file = $("#exampleInputFile2").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(){
                $("img#previewImg").attr("src", reader.result);
                console.log(file);
            }
            reader.readAsDataURL(file);
        }
    }
</script>