@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
    <div class="row py-5"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            <a data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseExample" class="font-weight-bold">+ Tambah Jenis Transaksi pada Developer</a>
            <form action="{{ route('admin.typeTrans.addNewtypeTrans') }}" method="POST" id="addNewtypeTrans">
                @csrf
                <div class="collapse show" id="collapseCategory">
                    <div class="col-md-12" style="padding:0.5rem;">
                        <div class="row px-2 py-2 text-dark">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label class="float-left">Tipe</label>
                                    <select class="form-control form-control-alternative text-dark" name="tipe" id="tipe">
                                        <option value="1">Pemasukkan</option>
                                        <option value="2">Pengeluaran</option>
                                    </select>
                                    <span class="text-danger error-text tipe_error"></span>
                                </div>
                            </div>
                           
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="float-left">Keterangan</label>
                                    <div class="input-group input-group-alternative mb-4">
                                        <input type="text" class="form-control form-control-alternative text-dark" name="keterangan" id="keterangan" >
                                        <div class="input-group-append">
                                            <button name="action" type="submit" class="btn btn-default" id="addCategory">Tambahkan</button>
                                        </div>
                                    </div>
                                </div> 
                                <span class="text-danger error-text keterangan_error"></span>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </form>
                

            <div class="card border-0 py-4 px-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_typeTrans">
                    <thead>
                        <tr style="text-align: center">
                            <th>#ID</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
                    <!-- AKHIR TABLE -->
                </div>
            </div>
        </div>
    </div><!-- end of row untuk header categoryProduct -->
</div>


@include('admin.transaksi.editTypeTrans')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="/js/admin/tipeTrans.js"></script>
<script>
    $("#type_trans").addClass('active');
</script>
<script src="/js/admin/custom.js"></script>
@endsection

