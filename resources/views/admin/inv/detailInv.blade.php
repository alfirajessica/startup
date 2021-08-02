{{-- tidak digunakan --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailDev">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            
        
            <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 id="nama_product"></h5>
                                </div>
                            </div>
        
                            <div class="row" id="row_link">
                                <div class="col-12">
                                    <i class="fas fa-external-link-alt"></i> 
                                    <a href="" id="url_product"></a>
                                </div>
                            </div>
        
                            <div class="row d-none" id="row_loc">
                                <div class="col-12">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <label id="loc_detailEvent"></label> <br>
                                    <label id="add_detailEvent"></label>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-12">
                                    <i class="fas fa-calendar-alt "></i> 
                                    <label id="rilis_product">  </label>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-12">
                                    <i class="fas fa-clock"></i>
                                    <label id="time_detailEvent"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

        <div class="row">
            <div class="col-md-12">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Proyek Terkonfirmasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Proyek Memiliki Investor</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" id="table_detailProduct">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Created at</th>
                                          <th>Tipe Trans</th>
                                          <th>Jumlah</th>
                                      </tr>
                                  </thead>
                                  <tbody></tbody>
                                  <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right; font-weight:bold">Total Pemasukkan :</th>
                                        <th style="font-weight:bold"></th>
                                    </tr>
                                    
                                    <tr>
                                        <th colspan="3" style="text-align:right; font-weight:bold">Total Pengeluaran :</th>
                                        <th style="font-weight:bold" id="totalsemua"></th>
                                    </tr>
                                </tfoot>
                                </table>
                              <!-- AKHIR TABLE -->
                              </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" id="table_detailProduct">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Created at</th>
                                          <th>Tipe Trans</th>
                                          <th>Jumlah</th>
                                      </tr>
                                  </thead>
                                  <tbody></tbody>
                                  <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right; font-weight:bold">Total Pemasukkan :</th>
                                        <th style="font-weight:bold"></th>
                                    </tr>
                                    
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
        </div>
      </div>
    </div>
</div>
