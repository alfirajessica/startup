<div class="form-group">
    <h2 class="fs-title">Detail Pengeluaran</h2> 
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="float-left">Tipe Pengeluaran</label>
                <select class="form-control form-control-alternative" name="" id="">
                    @foreach ($type_trans as $item)
                        @if ($item->tipe == "2")
                            <option value="{{$item->id}}"> {{$item->keterangan}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="float-left">Jumlah</label>
                <input type="number" name="" id="" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
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
<input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Konfirmasi Penyimpanan" />