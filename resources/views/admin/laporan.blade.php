@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
    <div class="row pt-5">
        <div class="col-md-8">
            <div class="alert alert-warning" role="alert">
                <strong>Info</strong><br>
                Hasil laporan akan berupa <b> file PDF </b><br>
                Diharapkan dapat memilih periode awal dan akhir sebelum mencetak laporan
            </div>
        </div>
    </div>
    <div class="row text-dark">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Periode awal</label>
                <input type="date" name="" id="date_awal" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="help_date_awal">
                <small id="help_date_awal" style="color: red"></small>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Periode akhir</label>
                <input type="date" name="" id="date_akhir" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="help_date_akhir">
                <small id="help_date_akhir" style="color: red"></small>
            </div>
        </div>

        <div class="col-md-10">

            <div class="form-group">
                <div class="input-group input-group-alternative mb-4" id="select_project">
                    <select name="pilih_cetaklap" id="pilih_cetaklap" class="form-control form-control-alternative text-dark" type="text"> 
                    <option value="-1" disabled>-- Pilih jenis laporan -- </option>
                    <option value="0">Laporan Pemasukkan</option>
                    <option value="1">Laporan Transaksi Investasi</option>
                    <option value="2">Laporan Developer dan Startup Terbaik</option>
                    <option value="3">Laporan Event Terdaftar</option>
                    <option value="4">Laporan Penilaian Investasi</option>
                    </select>
                    <div class="input-group-append">
                    {{-- <button class="btn btn-default" type="button" onclick="sesuaikan_cetak()">Unduh Laporan</button> --}}

                    <a class="btn btn-icon btn-3 btn-default text-white" type="button" onclick="sesuaikan_cetak()">
                        <span class="btn-inner--text">Unduh Laporan</span>
                        <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                    </a>
                    </div>
                </div>
            </div>     
        </div>
    </div>
   
</div>
<script src="/js/admin/report.js"></script>     
<script>
    $("#laporan_admin").addClass('active');
  </script>       
@endsection

