

<form action="{{ route('dev.listPemasukkan.addNewPemasukkan')}}" method="POST" id="pemasukkanProduct">
    @csrf
<div class="form-group">
    <h2 class="fs-title">Detail Pemasukkan</h2> 
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group input-group-alternative mb-4" id="select_project">
                  <select name="pilih_project_masuk" id="pilih_project_masuk" class="form-control form-control-alternative" type="text"> 
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-default" type="button" onclick="pilih_proyek()">Sesuaikan</button>
                  </div>
                </div>
            </div>     
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Saat ini sedang memasukkan pemasukkan pada proyek : 
                <label id="nama_project_dipilih_masuk"></label>
            </p>
        </div>
    </div>
    <div class="card border-0 d-none" id="card_masuk">
        <div class="row px-2 py-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="float-left">Tipe Pemasukkan</label>
                    <select class="form-control form-control-alternative" name="tipe_pemasukkan" id="tipe_pemasukkan">
                        <option value="0" disabled> --Pilih Tipe --</option>
                        @foreach ($type_trans as $item)
                            @if ($item->tipe == "1")
                                <option value="{{$item->id}}"> {{$item->keterangan}}</option>
                            @endif
                        @endforeach
                    </select>
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




<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script type="text/javascript">

    const url_table_listPemasukkan = "{{ route('dev.product') }}" + '/listPemasukkan/';
</script>
<script src="/js/dev/product.js"></script>