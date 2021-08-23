

<form action="{{ route('dev.listPemasukkan.addNewPemasukkan')}}" method="POST" id="pemasukkanProduct">
    @csrf
<div class="form-group">
    <h4> <strong>Detail Pemasukkan</strong> </h4> 
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
    
    <div class="card border-0 d-none text-dark" id="card_masuk">
        <div class="row px-2 pt-2 text-dark">
            <div class="col-md-12">
                <label style="color: black">*Saat ini Anda sedang memasukkan data alur kas masuk Pada Startup/Produk : 
                    <label id="nama_project_dipilih_masuk" style="color:blue" class="font-weight-bold"></label>
                </label>
            </div>
        </div>
        <div class="row px-2 pt-2 text-dark">
           <div class="col-md-6">
            <div class="form-group text-dark">
                <label for="">Pilih Tanggal</label>
                <input type="date" name="date_input" id="date_input" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="help_date_input">
                <span class="text-danger error-text date_input_error"></span>
            </div>
           </div>
           <div class="col-md-6">
            <div class="form-group text-dark">
                <label class="float-left">Tipe Pemasukkan</label>
                <select class="form-control form-control-alternative text-dark" name="tipe_pemasukkan" id="tipe_pemasukkan">
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
        </div>
        <div class="row px-2 pt-2">
            <div class="col-md-12">
                <div class="form-group text-dark">
                    <label class="float-left">Jumlah (Rp)</label>
                    <div class="input-group input-group-alternative mb-4"> 
                        <input type="text" name="jumlah" id="jumlah" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" min="1,00" class="form-control form-control-alternative">
                       
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">Simpan</button>
                      </div>        
                    </div>
                    <span class="text-danger error-text jumlah_error" style="font-size: 10pt"></span>
                    
                </div> 
                
            </div>
        </div>
        
        <div class="table-responsive px-2">
            <table class="table table-bordered table-hover text-dark table-sm" width="100%" id="table_listPemasukkan">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Tipe Masuk</th>
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

    $("#pemasukkanProduct").on("submit",function (e) {
        e.preventDefault();
        console.log($(['name="action"']).attr('id'));
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function() {
                $(document).find('span.error-text').text('');
            },
            success:function(data) {
                console.log(data)
                if (data == 1) {
                    swal({
                        text: "Berhasil menambah data",
                        icon: "success",
                    });
                    table_listPemasukkan();
                    var terpilih_before = $("#nama_project_dipilih_masuk").text();
                    $("#pilih_project_masuk").find(":selected").text(terpilih_before);
                    $('#tipe_pemasukkan').val(0);
                    $('#jumlah').val(0,00);
                    
                    
                }
                else if(data == -1){
                    var terpilih_before = $("#nama_project_dipilih_masuk").text();
                    $("#pilih_project_masuk").find(":selected").text(terpilih_before);
                    $('#tipe_pemasukkan').val(0);
                    $('#jumlah').val(0,00);
                    swal({
                        text: "Sudah terdata",
                        icon: "warning",
                    });
                    
                }
                else if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                
            }
        });
    });
</script>
<script src="/js/dev/product.js"></script>