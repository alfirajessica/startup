@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <div class="py-4"></div>
    <div class="row py-5">
        <div class="col-md-12" style="padding-left: 0rem">
                <div class="card shadow"> <!-- card shadow --> 
                  <div class="table-responsive px-2 py-2">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listDev">
                      <thead>
                          <tr style="text-align: center">
                              <th>#ID</th>
                              <th>Nama Dev</th>
                              <th>Email Dev</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>


{{-- modal --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailDev">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-11">
            <h3>Daftar Semua Startup/Produk Terdaftar pada Developer</h3>
            <h4 id="data_dev"></h4>
          </div>
      
          <div class="col-md-1">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 py-1">
              <!-- tab content -->
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_detailProjectTerdataDev">
                  <thead>
                      <tr style="text-align: center">
                          <th class="d-none">#ID</th>
                          <th>Dimuat</th>
                          <th>Startup/Produk</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              <!-- AKHIR TABLE -->
            </div>
          </div>
      </div>    
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="/js/admin/dev/listDev.js"></script>
<script>
  $("#list_dev").addClass('active');
</script>
<script src="/js/admin/custom.js"></script>
@endsection

