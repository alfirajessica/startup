@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
    <div class="row"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            <div class="card-body shadow">
                <a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">+ Tambah Kategori</a>
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

{{-- modal tambah kategori --}}
<form enctype="multipart/form-data" action="{{ route('admin.addNewCategoryProduct') }}" method="POST" id="addNewCategoryProduct">
@csrf
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kategori Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="category_product" class="col-form-label">Kateogri Produk:</label>
              <input type="text" class="form-control" name="category_product">
              <span class="text-danger error-text category_product_error"></span>
            </div>
          
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary" value="addCategory">Tambahkan</button>
        </div>
      </div>
    </div>
</div>
{{-- </form> --}}


{{-- modal tambah detail per kategori (bidang)--}}
{{-- <form action="{{ route('admin.addNewdetailCategoryProduct') }}" enctype="multipart/form-data" method="POST" id="detailCategoryProduct">
@csrf --}}
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Kategori Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" id="categoryID" name="categoryID"/>
            <div class="form-group">
                <label for="detailcategory_product" class="col-form-label">Kateogri Produk:</label>
                <input type="text" class="form-control" name="detailcategory_product">
                <span class="text-danger error-text detailcategory_product_error"></span>
            </div>
            
        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="save" class="btn btn-primary" value="addDetail">Tambahkan</button>
        </div>
        </div>
    </div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
    table1();
});

//function when user click button --Tambah kategori
$("#addNewCategoryProduct").on("submit",function (e) {
    e.preventDefault();
   
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
            else{
                $('#addNewCategoryProduct')[0].reset();
                $("#addNewCategoryProduct").attr('data-dismis', 'modal');
                alert(data.msg);
            }
        }
    });
});

function table1() {
    $('#table_category').DataTable({
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

$("#detailCategoryProduct").on("save",function (e) {
    e.preventDefault();
   
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
            else{
                $('#detailCategoryProduct')[0].reset();
                $("#detailCategoryProduct").attr('data-dismis', 'modal');
                alert(data.msg);
            }
        }
    });
});
</script>

@endsection

