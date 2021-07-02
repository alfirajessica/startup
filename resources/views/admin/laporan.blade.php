@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
     <h2 class="fs-title">Laporan</h2> 
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Periode awal</label>
                <input type="date" name="" id="date_awal" class="form-control" placeholder="" aria-describedby="help_date_awal">
                <small id="help_date_awal" class="text-muted"></small>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Periode akhir</label>
                <input type="date" name="" id="date_akhir" class="form-control" placeholder="" aria-describedby="help_date_akhir">
                <small id="help_date_akhir" class="text-muted"></small>
            </div>
        </div>
    </div>
    <div class="row"> <!-- row untuk header categoryProduct -->
        <div class="col-md-8">

            <div class="form-group">
                <div class="input-group input-group-alternative mb-4" id="select_project">
                    <select name="pilih_cetaklap" id="pilih_cetaklap" class="form-control form-control-alternative" type="text"> 
                    <option value="-1" disabled>-- Pilih jenis laporan -- </option>
                    <option value="0">Laporan Pemasukkan</option>
                    <option value="1">Laporan Transaksi Investasi</option>
                    <option value="2">Laporan Developer dan Startup Terbaik</option>
                    <option value="3">Laporan Event Terdaftar</option>
                    </select>
                    <div class="input-group-append">
                    <button class="btn btn-default" type="button" onclick="sesuaikan_cetak()">Sesuaikan</button>
                    </div>
                </div>
            </div>     
        </div>
    </div><!-- end of row untuk header categoryProduct -->

</div>
<script src="/js/admin/report.js"></script>            
@endsection

