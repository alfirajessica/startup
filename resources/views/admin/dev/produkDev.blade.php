@extends('layouts.adm')

@section('content')
<div class="container">
  <div class="py-4"></div>
    <div class="row py-5">
        <div class="col-md-12" style="padding-left: 0rem">
                <div class="card shadow"> <!-- card shadow -->
                  <div class="table-responsive px-2 py-2">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listProductConfirmYet">
                      <thead>
                          <tr style="text-align: center">
                              <th>#ID</th>
                              <th>Developer</th>
                              <th>Startup/Produk</th>
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

<!-- Modal -->
<form action="{{ route('admin.dev.listProductDev.notConfirmProject')}}" method="POST" id="modal_alasanTdkDikonfirmasi_form">
  @csrf
  <div class="modal fade" id="modal_alasanTdkDikonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-dark">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" id="productID" name="productID">
          <div class="form-group">
            <label for="">Berikan alasan kenapa Startup/produk tidak dikonfirmasi</label>
            <textarea name="reason_tdkdikonfirmasi" id="reason_tdkdikonfirmasi" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="reason_tdkdikonfirmasi_error" cols="2" rows="2"></textarea>
            <span class="text-danger error-text reason_tdkdikonfirmasi_error"></span>
          </div>
          <button type="submit" class="btn btn-default float-right">Simpan Alasan Ini</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="/js/admin/dev/product/productDev.js"></script>
<script>
  $("#produk_terbaru").addClass('active');
</script>
<script src="/js/admin/custom.js"></script>
@endsection
