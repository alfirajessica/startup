@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <h3 style="color: white">Produk Baru Terdaftar</h3> 
    <div class="row">
        <div class="col-md-12">
                <div class="card shadow"> <!-- card shadow -->
                  <div class="table-responsive px-2 py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_listProductConfirmYet">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Email Dev</th>
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
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <input type="text" id="productID" name="productID">
          <div class="form-group">
            <label for="">Berikan Alasan kenapa tidak dikonfirmasi</label>
            <input type="text" name="reason_tdkdikonfirmasi" id="reason_tdkdikonfirmasi" class="form-control" placeholder="" aria-describedby="helpId">
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


@endsection
