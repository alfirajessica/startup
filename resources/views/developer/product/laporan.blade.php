<div class="row">
    <div class="col-md-12">
         <h4> <strong>Laporan</strong> </h4> 
         <div class="alert alert-warning" role="alert">
            <strong>Info</strong><br>
            Hasil laporan akan berupa <b> file PDF </b>.<br>
            Anda dapat memilih Jenis laporan yang akan dicetak.
        </div>
        <div class="form-group text-dark">
            <div class="input-group input-group-alternative mb-4" id="select_project">
              <select name="pilih_cetaklap" id="pilih_cetaklap" class="form-control form-control-alternative text-dark" type="text"> 
                <option value="-1" disabled>-- Pilih jenis laporan yang akan di cetak -- </option>
                <option value="0">Semua Produk Terdaftar</option>
                <option value="1">Detail Produk</option>
                <option value="2">Transaksi Produk</option>
                <option value="3">Investor Produk</option>
                <option value="4">Review Produk</option>
                <option value="5">Lengkap Informasi Produk</option>
                <option value="6">Penilaian Investasi</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-default" type="button" onclick="sesuaikan_cetak()">Sesuaikan</button>
              </div>
            </div>
        </div>     
    </div>
</div>

<div class="card border-0 d-none text-dark shadow" id="card_laporan">
    <div class="row px-2 py-2 text-dark">
        <div class="col-md-6">
            <div class="form-group text-dark">
                <label for="">Periode awal</label>
                <input type="date" name="" id="date_awal" class="form-control text-dark" placeholder="" aria-describedby="help_date_awal">
                <small id="help_date_awal" style="color: red"></small>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group text-dark">
                <label for="">Periode akhir</label>
                <input type="date" name="" id="date_akhir" class="form-control text-dark" placeholder="" aria-describedby="help_date_akhir">
                <small id="help_date_akhir" style="color: red"></small>
            </div>
        </div>
    </div>
    <div class="row px-2 py-2">
        <div class="col-md-6">
            <div class="form-group text-dark">
                <label for="">Status Produk</label>
                <select class="form-control text-dark" name="" id="status_proyek">
                  <option value="0">Semua</option>
                  <option value="1">Aktif</option>
                  <option value="2">Memiliki investor</option>
                  <option value="3">Tidak aktif</option>
                </select>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group text-dark">
                <label for="">Pilih Startup/Produk</label>
                <select class="form-control text-dark" name="pilih_project_cetak" id="pilih_project_cetak"> 
                </select>
            </div>
        </div>
    </div>
    <div class="row px-2 py-2">
        <div class="col-md-12">
            <button type="button" class="btn btn-outline-default float-right" onclick="cetak_laporanProyek()">Cetak Laporan</button>
        </div>
    </div>
</div>


<script src="/js/dev/report.js"></script>