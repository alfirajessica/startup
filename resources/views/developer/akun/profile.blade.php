<form  method="POST" id="pemasukkanProduct">
    @csrf
<div class="form-group">
    <h2 class="fs-title">Detail Pemasukkan</h2> 
    
    <div class="card border-0 d-none" id="card_masuk">
        <div class="row px-2 py-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="float-left">Tipe Pemasukkan</label>
                        
                        
                    <span class="text-danger error-text tipe_pemasukkan_error"></span>
                </div>
            </div>
           
            <div class="col-md-8">
                <div class="form-group">
                    <label class="float-left">Jumlah (Rp)</label>
                    <div class="input-group input-group-alternative mb-4">
                      <input class="form-control" type="number" name="jumlah" id="jumlah">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">Simpan</button>
                      </div>
                    </div>
                </div> 
                <span class="text-danger error-text jumlah_error"></span>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table class="table table-bordered table-hover" width="100%" id="table_listPemasukkan">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipe Pemasukkan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <!-- AKHIR TABLE -->
        </div>
    </div>
</div>
</form>