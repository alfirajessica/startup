@extends('layouts.dev')
<link rel="stylesheet" href="/css/multisteps.css">

<style>
    section{
        padding-top: :100px;
    }
    .form-section{
        padding-left: 15px;
        display: none;
    }
    .form-section.current{
        display: inherit;

    }
    .btn-info, btn-btn-success{
        margin-top: 10px;
    }
    .parsley-errors-list{
        margin: 2px 0 3px;
        padding: 0;
        list-style-type: none;
        color: red;
    }
</style>
@section('content')
<div class="container">
    <div class="py-4"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Daftarkan Proyek Baru</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Pemasukkan</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Pengeluaran</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Semua Proyek saya</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    @include('developer.product.daftarProductBaru')
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    @include('developer.product.pemasukkanProduct')
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    @include('developer.product.pengeluaranProduct')
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    @include('developer.product.listProduct')
                </div>
            </div>
        </div>
    </div>
    
    
</div>

@include('developer.product.ubahPemasukkan')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>


<script>
  $(document).ready(function () {
        //  table1();
        show_detail();
      });

   function table1() {
     $('#table_pegawai').DataTable({
               processing: true,
               serverSide: true, //aktifkan server-side 
               responsive:true,
               deferRender:true,
               aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
               ajax: {
                   url: "{{ route('admin.dev.listDev') }}",
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
                       data: 'email',
                       name: 'email'
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
     
     //to show image what user had choosen in preview
function previewFile() {
    var file = $("#exampleInputFile").get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
            console.log(file);
        }
        reader.readAsDataURL(file);
    }
}

function show_detail() { 
    var id = $('#jenis_produk').val();
    console.log(id);

    $.get("{{ route('dev.product') }}" + '/' + id, function (data) {
        $('#detail_kategori').empty();
        
         for (let i = 0; i < data.list_detailcategory.length; i++) {
             console.log(data.list_detailcategory[i]["id"])

             var idnya = data.list_detailcategory[i]["id"];
             var isi = data.list_detailcategory[i]["name"];

             $('#detail_kategori').append('<option value="'+ idnya + '">' + isi + '</option>');
            
         }
  
     })
}
</script>
@endsection

