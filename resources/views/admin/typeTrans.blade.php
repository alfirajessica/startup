@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
    <div class="row"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            
            
            {{-- data-toggle="modal" data-target="#exampleModal"  --}}
            <a data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseExample">+ Tambah Kategori</a>

            <form action="{{ route('admin.addNewtypeTrans') }}" method="POST" id="addNewtypeTrans">
                @csrf
                <div class="collapse show" id="collapseCategory">
                    <div class="card border-0 card-body card-shadow col-md-12" style="background-color: #0a1931; padding:0.5rem;">
                        <div class="row px-2 py-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="float-left">Tipe Pemasukkan</label>
                                    <select class="form-control form-control-alternative" name="tipe" id="">
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
                                        <input type="text" class="form-control" name="keterangan" >
                                        <div class="input-group-append">
                                            <button name="action" type="submit" class="btn btn-primary" id="addCategory">Tambahkan</button>
                                        </div>
                                    </div>
                                </div> 
                                <span class="text-danger error-text category_product_error"></span>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </form>
                

            <div class="card border-0 py-4 px-4">
                <div class="table-responsive py-2">
                    <table class="table table-bordered table-hover" width="100%" id="table_typeTrans">
                    <thead>
                        <tr>
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

<script src="/js/admin/tipeTrans.js"></script>

@endsection

