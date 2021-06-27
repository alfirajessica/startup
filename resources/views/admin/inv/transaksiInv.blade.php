@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <h3 style="color: white">Transaksi Investasi</h3>
    <div class="row">
      {{-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2"> --}}
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                {{-- <div class="card"> <!-- card shadow -->  --}}
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestConfirmYet">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
      {{-- </main> --}}
    </div>
</div>


{{-- @extends('layouts.adm')

@section('content')
<div class="container-fluid">
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card shadow"> <!-- card shadow --> 
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestConfirmYet">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                </div>
            </div>
        </div>
      </main>
    </div>
</div>         --}}

{{-- modal detail dari transaksi investasi --}}
@include('admin.inv.detailTrans')
{{-- end of modal detail dari transaksi investasi --}}


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="/js/admin/inv/transaksi/listInvest.js"></script>


@endsection