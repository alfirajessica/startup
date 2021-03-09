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

                @include('admin.category.addCategory')

                <div class="table-responsive py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_category">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nama</th>
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

    <div class="row py-2 d-none" id="row_detailCategory"> <!-- row untuk detail categoryProduct -->
        <div class="col-md-12">
            <div class="card-body shadow">
                <a data-toggle="modal" data-target="#exampleModal2">+ Tambah Detail Kategori</a>
                <div class="table-responsive py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_detailcategory">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nama Detail category</th>
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
    </div><!-- end of row untuk detail categoryProduct -->
</div>


@include('admin.category.editCategory')

@include('admin.category.addDetailCategory')


{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>       --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    table1();
    setTimeout(function(){
        document.querySelector('#alert_success').classList.add('d-none');
        document.querySelector('#alert_danger').classList.add('d-none');
    }, 5000 ); // 5 secs
});



function table1() {
    $('#table_category').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('admin.categoryProduct') }}",
            type: 'GET'
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name_category',
                name: 'name_category'
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

//if table_category has clicked in detail
$('body').on('click', '.detailKategori', function () {
    var id = $(this).data("id");
    table2(id);
    $('#categoryID').val(id);
    document.querySelector('#row_detailCategory').classList.remove('d-none');
});

$('body').on('click', '.deleteKategori', function () {
    var id = $(this).data("id");
    var txt;
    if (confirm("Are You sure want to delete !")) {
        //txt = "You pressed OK!";
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
    } else {
        console.log('You pressed Cancel!');
    }

});

$('body').on('click', '.editCategory', function () {
    var id = $(this).data('id');
    $('#collapseCategory').collapse('show');

    document.querySelector('#addCategory').classList.add('d-none');
    $.get("{{ route('admin.categoryProduct') }}" +'/editKategori' + '/' + id, function (data) {
        $('#edit_categoryID').val(id);
        $('#edit_category_product').val(data.name_category);
        console.log(data.name_category);
    })

    //sekarang tinggal atur gimana kalau nnti dia mau update,
    //tombol modal diubah jadi "Simpan Perubahan Kategori"
});


//call table_detailcategory which user see the detail of table_category 
function table2(id) {
    $('#table_detailcategory').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('admin.categoryProduct') }}"+'/detailKategori' + '/' + id,
            type: 'GET'
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
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

$('body').on('click', '.deleteDetailKategori', function () {
    var id = $(this).data("id");
    var txt;
    if (confirm("Are You sure want to delete !")) {
        //txt = "You pressed OK!";
        $.ajax({
        type: "get",
        url: "{{ route('admin.categoryProduct') }}"+'/deleteDetailKategori' + '/' + id,
        success: function (data) {
            table2(id);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
    } else {
        console.log('You pressed Cancel!');
    }

    

});


</script>

@endsection

