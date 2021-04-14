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
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
</style>
@section('content')
<div class="col-md-12">
    <div class="card px-0 pb-0 mt-3 mb-3 border-0">
        <h2><strong>Daftarkan Proyek Baru Saya</strong></h2>
        <p>Isi semua form untuk ke halaman selanjutnya</p>
        <div class="row">
            <div class="col-md-12 mx-0">
                <form id="msform" class="contact-form">
                    @csrf
                    <!-- progressbar -->
                    
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Singkat Produk</strong></li>
                        <li id="personal"><strong>Detail</strong></li>
                        
                    </ul> <!-- fieldsets -->
                        
                        <div class="form-section">
                            <h2 class="fs-title">Informasi Produk</h2> 
                            <div class="form-group">
                                <label class="float-left">Nama produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" aria-describedby="nama_produk_error" required>
                                <span class="text-danger error-text nama_produk_error"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Jenis Produk</label>
                                        <select class="form-control form-control-alternative" name="jenis_produk" id="jenis_produk" onchange="show_detail(this)" required>
                                            @foreach($list_category as $category)
                                            <option value="{{$category->id}}"> {{$category->name_category}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text jenis_produk_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Dalam Kategori</label>
                                        <select class="form-control form-control-alternative" name="detail_kategori" id="detail_kategori" required>    
                                        </select>
                                        <span class="text-danger error-text detail_kategori_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Domain Produk</label>
                                        <input type="url" name="url" id="url" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                                        <span class="text-danger error-text url_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Tanggal Perilisan produk</label>
                                        <input type="date" name="rilis" id="rilis" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                                        <span class="text-danger error-text rilis_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" class="form-control-file"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
                                    <span class="text-danger error-text image_error"></span>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <a href="#" id="pop">
                                <img id="previewImg" style="max-width: 250px; margin-top:20px" src="{{asset('images')}}">
                                </a>  
                            </div>
                        </div>
                    
                        <div class="form-section">
                            <div class="form-group">
                                <h2 class="fs-title">Detail Informasi Produk</h2> 
                                <div class="form-group">
                                    <label class="float-left">Deskripsikan produk anda</label>
                                    <textarea class="form-control form-control-alternative" name="desc" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Siapa saja yang ada didalam Tim anda</label>
                                    <textarea class="form-control form-control-alternative" name="team" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Alasan kenapa Anda membutuhkan investor</label>
                                    <textarea class="form-control form-control-alternative" name="reason" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Keuntunggan yang akan diperoleh investor</label>
                                    <textarea class="form-control form-control-alternative" name="benefit" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Solusi yang anda tawarkan</label>
                                    <textarea class="form-control form-control-alternative" name="solution" id="" rows="3"></textarea>
                                </div>
                            
                            </div> 
                        </div>
                    
                        <div class="form-navigation">
                            <button type="button" class="previous btn btn-info float-left">Sebelumnya</button>
                    
                            <button type="button" class="next btn btn-info float-right">Selanjutnya</button>
                    
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection