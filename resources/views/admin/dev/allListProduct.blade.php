@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <h3 style="color: white">Produk Terdata</h3>
    <div class="row">
      {{-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2"> --}}
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                <div class="card"> <!-- card shadow -->
                  <div class="table-responsive px-2 py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_allListProductDev">
                      <thead>
                          <tr>
                              <th>#Id Startup</th>
                              <th>Developer</th>
                              <th>Startup/Produk</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                </div>
            {{-- </div> --}}
        </div>
      {{-- </main> --}}
    </div>
</div>    
@include('admin.dev.detailProduct')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="/js/admin/dev/listProduct.js"></script>


@endsection