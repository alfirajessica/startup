{{-- modal detail dari transaksi investasi --}}
@include('investor.invest.detailTrans')
{{-- end of modal detail dari transaksi investasi --}}
<div class="row">
  <div class="col-md-12">
    
  </div>
</div>

<div class="col-md-12 py-2">
    <!-- card -->
    <div class="card">
      <div class="card shadow border-0">
      <div class="card-body"> <!-- card body -->
        <!-- tab content -->
        <div class="alert alert-primary" role="alert">
          <strong>Cetak Laporan dengan menekan tombol ini</strong>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
          </button>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- table_listInvestPending -->
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <div class="alert alert-info" role="alert">
                  <strong>info</strong> Mohon refresh halaman ini jika sudah melakukan pembayaran
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestPending">
                      <thead>
                          <tr>
                              <th>Invest_id</th>
                              <th>Project</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <!-- end of table_listInvestPending -->

            <!-- table_listInvestSettlement -->
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
              
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestSettlement">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Event</th>
                              <th>Diadakan Secara</th>
                              <th>Jadwal Acara</th>
                             
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
            </div> 
            <!-- end of table_listInvestSettlementt -->

            <!-- table_listInvestCancel -->
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestCancel">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Event</th>
                              <th>Diadakan Secara</th>
                              <th>Jadwal Acara</th>
                             
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
            </div>
            <!-- end of table_listInvestCancel -->

            <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
              <div class="table-responsive">
                  <table class="table table-bordered table-hover" width="100%" id="table_listInvestFinished">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Event</th>
                            <th>Diadakan Secara</th>
                            <th>Jadwal Acara</th>
                           
                        </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                <!-- AKHIR TABLE -->
                </div>
            </div>
        </div> <!-- end of tab content -->
      </div> <!--end of card body -->
      </div>
    </div>
    <!-- end card -->
</div>

<!-- Modal untuk cetak laporan investasi-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for=""></label>
              <input type="date" name="" id="date_awal" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Help text</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for=""></label>
              <input type="date" name="" id="date_akhir" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Help text</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for=""></label>
              <select class="form-control form-control-alternative" name="" id="select_jenislaporan">
                <option value="0">Semua Investasi</option>
                <option value="1">Investasi Aktif</option>
                <option value="2">Investasi Gagal/Cancel</option>
                <option value="3">Investasi Selesai</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="cetak_riwayatInv()">Cetak Laporan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

<script src="/js/inv/invest.js"></script>