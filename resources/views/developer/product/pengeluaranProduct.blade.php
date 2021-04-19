
<form action="{{ route('dev.listPengeluaran.addNewPengeluaran')}}" method="POST" id="pengeluaranProduct">
    @csrf
<div class="form-group">
    <h2 class="fs-title">Detail Pengeluaran</h2> 
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group input-group-alternative mb-4">
                  <select name="pilih_project_keluar" id="pilih_project_keluar" class="form-control form-control-alternative" type="text"> 
                    {{-- @foreach ($list_project as $item)
                        <option value="{{$item->id}}">#{{$item->id}} - {{$item->name_product}}</option>
                    @endforeach --}}
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-outline-default" type="button" onclick="pilih_proyek_keluar()">Sesuaikan</button>
                  </div>
                </div>
              </div>     
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Saat ini sedang memasukkan pemasukkan pada proyek : 
                <label id="nama_project_dipilih_keluar"></label>
            </p>
        </div>
    </div>
    <div class="card border-0 d-none" id="card_keluar">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="float-left">Tipe Pengeluaran</label>
                    <select class="form-control form-control-alternative" name="tipe_pengeluaran" id="tipe_pengeluaran">
                        <option value="0" disabled> --Pilih Tipe --</option>
                        @foreach ($type_trans as $item)
                            @if ($item->tipe == "2")
                                <option value="{{$item->id}}"> {{$item->keterangan}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label class="float-left">Jumlah</label>
                    <div class="input-group input-group-alternative mb-4">
                      <input class="form-control" type="number" name="jumlah_keluar" id="jumlah_keluar">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                </div> 
                <span class="text-danger error-text jumlah_error"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" id="table_listPengeluaran">
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>



<script type="text/javascript">

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
                $('#jumlah_keluar').val('');
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
                table_listPengeluaran();
                var terpilih_before = $("#nama_project_dipilih_keluar").text();
                 $("#pilih_project_keluar").find(":selected").text(terpilih_before);
                 $('#tipe_pengeluaran').val(0);
                 $('#jumlah_keluar').val('');
                
                
            }
        }
    });
});

function pilih_proyek_keluar() {
    $("#card_keluar").removeClass('d-none');

    var id = $("#pilih_project_keluar").find(":selected").val();
    $("#nama_project_dipilih_keluar").text($("#pilih_project_keluar").find(":selected").text());
    $("#pilih_project_keluar").val(id);
   table_listPengeluaran();
}

function table_listPengeluaran() {
    var id = $("#pilih_project_keluar").find(":selected").val();
    console.log(id);
    $('#table_listPengeluaran').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.product') }}" + '/listPengeluaran/' + id,
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
              
            },
            {
                data:'action',
                name:'action',
            },
        ],
        
    });
}

$('body').on('click', '.editKas', function () {
      var product_id = $(this).data('id');
      console.log(product_id);
      $.get("{{ route('dev.product') }}" +'/detailPemasukkan' + '/' + product_id, function (data) {
            $("#nama_tipe").text($("#pilih_project").find(":selected").text()+"/");
            $('#id_detail_product_kas').val(data.id);
            $('#edit_jumlah').val(data.jumlah);
            $('#status_kas').val("Pengeluaran");
      })  
});

$('body').on('click', '.deleteKasKeluar', function () {
    var id = $(this).data("id");
    var txt;
    swal({
        title: "Are You sure want to delete?",
        text: "Once deleted, you will not be able to recover this event!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "{{ route('dev.product') }}"+'/deletePengeluaran' + '/' + id,
                success: function (data) {
                    table_listPengeluaran();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
 });

</script>