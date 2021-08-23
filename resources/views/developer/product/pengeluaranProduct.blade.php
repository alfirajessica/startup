
<form action="{{ route('dev.listPengeluaran.addNewPengeluaran')}}" method="POST" id="pengeluaranProduct">
    @csrf
<div class="form-group">
    <h4> <strong>Detail Pengeluaran</strong> </h4> 
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group input-group-alternative mb-4">
                  <select name="pilih_project_keluar" id="pilih_project_keluar" class="form-control form-control-alternative" type="text"> 
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-default" type="button" onclick="pilih_proyek_keluar()">Sesuaikan</button>
                  </div>
                </div>
              </div>     
        </div>
    </div>
   
    <div class="card border-0 d-none text-dark" id="card_keluar">
        <div class="row px-2 pt-2 text-dark">
            <div class="col-md-12">
                <label style="color: black">*Saat ini Anda sedang memasukkan data alur kas keluar Pada Startup/Produk : 
                    <label id="nama_project_dipilih_keluar" style="color:blue" class="font-weight-bold"></label>
                </label>
            </div>
        </div>
        <div class="row px-2 pt-2 text-dark">
            <div class="col-md-6">
             <div class="form-group text-dark">
                 <label for="">Pilih Tanggal</label>
                 <input type="date" name="date_output" id="date_output" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="help_date_output">
                 <span class="text-danger error-text date_output_error"></span>
             </div>
            </div>
            <div class="col-md-6">
                <div class="form-group text-dark">
                    <label class="float-left">Tipe Pengeluaran</label>
                    <select class="form-control form-control-alternative text-dark" name="tipe_pengeluaran" id="tipe_pengeluaran">
                        <option value="0" disabled> --Pilih Tipe --</option>
                        @foreach ($type_trans as $item)
                            @if ($item->tipe == "2")
                                <option value="{{$item->id}}"> {{$item->keterangan}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
         </div>
        <div class="row px-2 py-2">
            
            <div class="col-md-12">
                <div class="form-group text-dark">
                    <label class="float-left">Jumlah (Rp)</label>
                    <div class="input-group input-group-alternative mb-4">
                        <input type="text" name="jumlah_keluar" id="jumlah_keluar" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">Simpan</button>
                      </div>
                    </div>
                </div> 
              
                <span class="text-danger error-text jumlah_keluar_error" style="font-size: 10pt"></span>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table class="table table-bordered table-hover text-dark table-sm" width="100%" id="table_listPengeluaran">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Tipe Keluar</th>
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


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>      
<script type="text/javascript">

    const url_table_listPengeluaran = "{{ route('dev.product') }}" + '/listPengeluaran/';

    $("#pengeluaranProduct").on("submit",function (e) {
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
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else if (data.status == -1) { 
                    //$('#pengeluaranProduct')[0].reset();
                    var terpilih_before = $("#nama_project_dipilih_keluar").text();
                    $("#pilih_project_keluar").find(":selected").text(terpilih_before);
                    $('#tipe_pengeluaran').val(0);
                    $('#jumlah_keluar').val(0,00);
                    swal({
                        text: data.msg,
                        icon: "warning",
                    });

                }
                else{
                    swal({
                        text: "Berhasil menambah data",
                        icon: "success",
                    });
                    table_listPengeluaran();
                    var terpilih_before = $("#nama_project_dipilih_keluar").text();
                    $("#pilih_project_keluar").find(":selected").text(terpilih_before);
                    $('#tipe_pengeluaran').val(0);
                    $('#jumlah_keluar').val(0,00);
                    
                }
            }
        });
    });
</script>
<script src="/js/dev/product.js"></script>