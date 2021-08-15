@extends('layouts.inv')

@section('content')
<div class="container">
    
     <!-- card shadow -->
      <div class="row"> <!-- row -->
        <div class="col-md-12">
          <div class="nav-wrapper">
            <!-- tabs -->
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"></i>Pembayaran & Konfirmasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Daftar Investasi Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-weight-bold mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Investasi Gagal/Cancel</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-weight-bold mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">Investasi Selesai</a>
                </li>
            </ul>
        </div>
        </div>

        @include('investor.invest.listInvest')

        
      </div>
</div>
<script type="text/javascript" src="../js/tawk.js"></script>
@endsection

