<div class="modal fade bd-example-modal-lg" id="detailTrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <div class="col-md-11">
              <div class="nav-wrapper">
                  <!-- tabs -->
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" id="detailInv-tab" data-toggle="tab" href="#detailInv" role="tab" aria-controls="detailInv" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Detail Investasi</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="lapfinance-tab" data-toggle="tab" href="#lapfinance" role="tab" aria-controls="lapfinance" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Laporan Keuangan Startup</a>
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
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <!-- tab content -->
                <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="detailInv" role="tabpanel" aria-labelledby="detailInv-tab">
                        <div class="row">
                          <div class="col-md-12">
                            <input type="text" id="project_id">
                              <div class="card">
                                  <div class="card-header">Project Details</div>
                                  <div class="card-body">
                                    <div class="table-responsive-lg">
                                      <table class="table table-sm padding-0" width="100%" id="table_projectDetails">
                                          <thead>
                                              <th>Invest_id</th>
                                              <th>Project</th>
                                              <th>Dev</th>
                                              <th>Tipe</th>
                                              <th>Aksi</th>
                                          </thead>
                                          <tbody></tbody>
                                          <tfoot>
                                            <tr>
                                              <th colspan="4" style="text-align:right; font-weight:bold">Fee Investasi : </th>
                                              <th style="font-weight:bold" id="fee"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align:right; font-weight:bold">Total Investasi : </th>
                                                <th style="font-weight:bold" id="totalsemua"></th>
                                            </tr>
                                          </tfoot>
                                      </table>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row py-4">
                        {{-- payment information --}}
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">Invest Details</div>
                            <div class="card-body">
                              <div class="table-responsive-lg">
                                <table class="table table-sm padding-0" width="100%" id="table_detailOrder">
                                  <tbody>
                                    <tr>
                                      <td>Waktu Awal Investasi</td>
                                      <td id='invest_awal'></td>
                                    </tr>
                                    <tr>
                                      <td>Masa Berlaku Investasi</td>
                                      <td id='invest_exp'></td>
                                    </tr>
                                    <tr>
                                      <td>Invest Id</td>
                                      <td id='invest_id'></td>
                                    </tr>
                                    <tr>
                                        <td>Transaksi ID</td>
                                        <td id='transaction_id'></td>
                                    </tr>
                                    <tr>
                                      <td>Tipe Pembayaran</td>
                                      <td id='pay_type'></td>
                                    </tr>
                                    <tr>
                                        <td>Status Investasi</td>
                                        <td id='msg_admin'></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- end of payment information --}}
          
                        {{-- investor and developer information --}}
                        <div class="col-md-6">
                            <div class="card">
                              <div class="card-header">Payment Details</div>
                              <div class="card-body">
                                <div class="table-responsive-lg">
                                  <table class="table table-sm padding-0" width="100%" id="table_payDetails">
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                        {{-- end of investor and developer information --}}
                    </div>

                    </div>
                    <div class="tab-pane fade show" id="lapfinance" role="tabpanel" aria-labelledby="lapfinance-tab">
                        <div class="alert alert-info" role="alert">
                          <strong>info</strong> Laporan Keuangan pada proyek
                          <strong id="proyek_nama"></strong> terhitung sejak 
                          <strong id="invest_awal_m"> </strong> sampai dengan <strong id="invest_exp_m"> </strong>
                        </div>
                        <button type="submit" id="d_lapFinanceInv" >Download Laporan</button>
                        <div class="row">
                          <div class="col">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link " id="pemasukkan-tab" data-toggle="tab" href="#pemasukkan" role="tab" aria-controls="pemasukkan" aria-selected="true">Pemasukkan</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pengeluaran-tab" data-toggle="tab" href="#pengeluaran" role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                                </li>
                            </ul>

                            <div class="tab-content py-4 bg-white" id="myTabContent">
                                
                                <div class="tab-pane fade show active" id="pemasukkan" role="tabpanel" aria-labelledby="pemasukkan-tab">
                                    <div class="col-md-12">
                                      <a class="btn" target="_blank" onclick="btn_d_lapFinanceInv()">Cetak PDF</a>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-sm" width="100%" id="table_pemasukkan_inv">
                                              <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Tipe</th>
                                                    <th>Masuk</th>
                                                    <th>Keluar</th>
                                                    <th>Akhir</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                              <tr>
                                                <th colspan="3"></th>
                                                <th id="total_masuk"></th>
                                                <th id="total_keluar"></th>
                                                <th id="total_akhir"></th>
                                              </tr>
                                             
                                             
                                            </tfoot>
                                            
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                          <table class="table table-bordered table-hover table-sm" width="100%" id="table_pengeluaran_inv">
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
                                                  <th colspan="3" style="font-weight:bold">Total Pengeluaran :</th>
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
          </div>
            
        </div>
       
      </div>
    </div>
  </div>

