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
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Pembayaran & Konfirmasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Daftar Investasi Aktif</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Investasi Gagal/Cancle/Tdk Aktif</a>
              </li>
            </ul>
        </div>
        </div>

        @include('investor.invest.listInvest')

        
      </div>
</div>
@endsection

