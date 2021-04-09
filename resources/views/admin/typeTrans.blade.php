@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
    <div class="row"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            
            <div class="card border-0 py-4">
                {{-- data-toggle="modal" data-target="#exampleModal"  --}}
                <a data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseExample">+ Tambah Kategori</a>

                @include('admin.transaksi.addTypeTrans')

                <div class="table-responsive py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_typeTrans">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
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
    </div><!-- end of row untuk header categoryProduct -->
</div>


@include('admin.transaksi.editTypeTrans')



{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>       --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    table1();
    // setTimeout(function(){
    //     document.querySelector('#alert_success').classList.add('d-none');
    //     document.querySelector('#alert_danger').classList.add('d-none');
    // }, 5000 ); // 5 secs
});



function table1() {
    $('#table_typeTrans').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('admin.typeTrans') }}",
            type: 'GET'
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: null,
                name: 'tipe',
                render: data => {
                    if (data.tipe == "1") {
                        return "Pemasukkan";
                    }else{
                        return "Pengeluaran";
                    }
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: null,
                name: 'status',
                render: data => {
                    if (data.status == "1") {
                        return "Aktif";
                    }else{
                        return "Tidak Aktif";
                    }
                }
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        order: [
            [0, 'asc']
        ]
    });
}

//if table_typeTrans has clicked in detail
$('body').on('click', '.detailKategori', function () {
    var id = $(this).data("id");
    table2(id);
    $('#categoryID').val(id);
    document.querySelector('#row_detailCategory').classList.remove('d-none');
});

$('body').on('click', '.deleteKategori', function () {
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
                url: "{{ route('admin.categoryProduct') }}"+'/deleteKategori' + '/' + id,
                success: function (data) {
                    table1();
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

$('body').on('click', '.editTypeTrans', function () {
    var id = $(this).data('id');
    $('#collapseCategory').collapse('show');

    //document.querySelector('#addCategory').classList.add('d-none');
    $.get("{{ route('admin.typeTrans') }}" +'/editTypeTrans' + '/' + id, function (data) {
        $('#edit_type_ID').val(id);
        var tipeheader = data.tipe;
        if (tipeheader == "1") {
            $('#tipeTrans').val("Pemasukkan");
        }else{
            $('#tipeTrans').val("Pengeluaran");
        }
        
        $('#edit_type_ket').val(data.keterangan);
        console.log(data.tipe);
    })
});



</script>

@endsection

