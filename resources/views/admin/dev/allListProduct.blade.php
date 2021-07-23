@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <div class="py-4"></div>
  <div class="row py-5">
        <div class="col-md-12" style="padding-left: 0rem">
                <div class="card"> <!-- card shadow -->
                  <div class="table-responsive px-2 py-2">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_allListProductDev">
                      <thead>
                          <tr style="text-align: center">
                              <th>#ID</th>
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
<script>
  $("#produk_terdata").addClass('active');
</script>

@endsection