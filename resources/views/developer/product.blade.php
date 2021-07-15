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
        text-align: left;
        font-size: small;
    }
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
</style>
@section('content')
<div class="container">
    <div class="py-4"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills py-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link mb-2 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Daftarkan Startup/Produk</a>
                <a class="nav-link mb-2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Pemasukkan</a>
                <a class="nav-link mb-2" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Pengeluaran</a>
                <a class="nav-link mb-2" id="v-pills-ulasan-tab" data-toggle="pill" href="#v-pills-ulasan" role="tab" aria-controls="v-pills-ulasan" aria-selected="false">Ulasan</a>
                <a class="nav-link mb-2" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Semua Startup/Produk saya</a>
                <a class="nav-link" id="v-pills-laporan-tab" data-toggle="pill" href="#v-pills-laporan" role="tab" aria-controls="v-pills-laporan" aria-selected="false">Laporan</a>
            </div>
        </div>
        <div class="col-md-9 py-2">
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
                <div class="tab-pane fade" id="v-pills-ulasan" role="tabpanel" aria-labelledby="v-pills-ulasan-tab">
                    @include('developer.product.listUlasan')
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    @include('developer.product.listProduct')
                </div>
                <div class="tab-pane fade" id="v-pills-laporan" role="tabpanel" aria-labelledby="v-pills-laporan-tab">
                    @include('developer.product.laporan')
                </div>
            </div>
        </div>
    </div>
</div>

@include('developer.product.ubahPemasukkan')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script>
    $(document).ready(function () {
        
        show_detail();
    });

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
            $('select[name="detail_kategori"]').append('<option value="" selected>-- pilih Sub kategori --</option>');
            for (let i = 0; i < data.list_detailcategory.length; i++) {
                console.log(data.list_detailcategory[i]["id"])

                var idnya = data.list_detailcategory[i]["id"];
                var isi = data.list_detailcategory[i]["name"];

                $('#detail_kategori').append('<option value="'+ idnya + '">' + isi + '</option>');
                
            }
    
        })
    }
</script>
<script src="/js/dev/listproduct.js"></script>
@endsection

