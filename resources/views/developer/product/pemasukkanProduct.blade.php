
<div class="form-group">
    <h2 class="fs-title">Detail Pemasukkan</h2> 
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group input-group-alternative mb-4">
                  <select name="pilih_project" id="pilih_project" class="form-control form-control-alternative" type="text"> 
                    @foreach ($list_project as $item)
                        <option value="{{$item->id}}">#{{$item->id}} - {{$item->name_product}}</option>
                    @endforeach
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-outline-default" type="button" onclick="pilih_proyek()">Sesuaikan</button>
                  </div>
                </div>
              </div>     
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Saat ini sedang memasukkan pemasukkan pada proyek : 
                <label id="nama_project_dipilih"></label>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="float-left">Tipe Pemasukkan</label>
                <select class="form-control form-control-alternative" name="tipe_pemasukkan" id="tipe_pemasukkan" onchange="tipe(this)">
                    @foreach ($type_trans as $item)
                        @if ($item->tipe == "1")
                            <option value="{{$item->id}}"> {{$item->keterangan}}</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-danger error-text tipe_pemasukkan_error"></span>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <label class="float-left">Jumlah</label>
                <div class="input-group input-group-alternative mb-4">
                  <input class="form-control" type="number" name="jumlah">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
            </div> 
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
</form>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
function tipe() {
    //console.log($("#tipe_pemasukkan").val())
  }
$("#addNewPemasukkan").on("submit",function (e) {
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
                $('#addNewPemasukkan')[0].reset();
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "warning",
                });

            }
            else{
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "success",
                });
                 $('#addNewPemasukkan')[0].reset();
                
            }
        }
    });
});

function pilih_proyek() {
    //console.log($("#pilih_project").find(":selected").text());
    $("#nama_project_dipilih").text($("#pilih_project").find(":selected").text());
}

</script>