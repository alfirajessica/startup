
@include('investor.event.editEvent')
@include('investor.event.detailEvent')
<div class="row py-2">
  <div class="col-md-12">
    <strong>Cetak Laporan dengan menekan tombol ini </strong>
    <button type="button" class="btn btn-default mx-4" data-toggle="modal" data-target="#exampleModalCenter">
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
                    <th>Diadakan</th>
                    <th>Jadwal</th>
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
        <div class="modal-body text-dark"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Periode Awal</label>
                        <input type="date" name="" id="date_awal" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                        <small id="help_date_awal" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Periode Akhir</label>
                        <input type="date" name="" id="date_akhir" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                        <small id="help_date_akhir" class="text-muted"></small>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Diadakan Secara</label>
                        <select class="form-control form-control-alternative" name="" id="select_jenisEvent">
                            <option value="0">Semua</option>
                            <option value="1" selected>Online</option>
                            <option value="2">Offline</option>
                        </select>
                        <small id="help_select_jenisEvent" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status Event</label>
                            <select class="form-control form-control-alternative" name="" id="select_statusEvent">
                            <option value="0">Semua</option>
                            <option value="1" selected>Aktif</option>
                            <option value="4">Tidak Aktif</option>
                            <option value="2">Selesai</option>
                            </select>
                            <small id="help_select_statusEvent" class="text-muted"></small>
                        </div>
                    </div>
                    </div>
           
          <div class="row">
          
            <div class="col-md-12">
              <button type="button" class="btn btn-default float-right" onclick="cetak_riwayatEvent()">Cetak Laporan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
