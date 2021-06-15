
@include('investor.event.editEvent')
@include('investor.event.detailEvent')
<div class="row py-4">
    <div class="alert alert-primary" role="alert">
        <strong>Cetak Laporan dengan menekan tombol ini</strong>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
          Cetak Laporan Event
        </button>
      </div>
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Diadakan Secara</th>
                    <th>Jadwal Acara</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>


<!-- Modal untuk cetak laporan event-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for=""></label>
                        <input type="date" name="" id="date_awal" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
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
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for=""></label>
                        <select class="form-control form-control-alternative" name="" id="select_jenisEvent">
                            <option value="0">Semua</option>
                            <option value="1">Online</option>
                            <option value="2">Offline</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control form-control-alternative" name="" id="select_statusEvent">
                            <option value="0">Semua</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
                            <option value="2">Selesai</option>
                            </select>
                        </div>
                    </div>
                    </div>
           
          <div class="row">
          
            <div class="col-md-12">
              <button type="button" class="btn btn-primary" onclick="cetak_riwayatEvent()">Cetak Laporan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script src="/js/inv/event.js"></script>