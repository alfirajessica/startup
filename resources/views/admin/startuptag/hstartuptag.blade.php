@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
    
    <div class="row"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            <a data-toggle="collapse" href="#collapseCategory" role="button" aria-expanded="false" aria-controls="collapseExample">+ Tambah Tag</a>

                <form action="{{ route('admin.startupTags.addNewHStartupTag') }}" method="POST" id="addNewHStartupTag">
                    @csrf
                    <div class="collapse show" id="collapseCategory">
                        <div class="card border-0 card-body card-shadow col-md-8" style="padding:0.5rem;">
                            <div class="form-group">
                                <label for="h_StartupTagName" class="col-form-label">Masukkan Tag:</label>
                                <div class="input-group input-group-alternative mb-4" >
                                    <input type="text" class="form-control" name="h_StartupTagName" id="h_StartupTagName" >
                                    <div class="input-group-append">
                                        <button class="btn btn-default" type="submit">Tambahkan</button>
                                    </div>
                                </div>
                                <span class="text-danger error-text h_StartupTagName_error"></span>
                            </div>  
                            
                        </div>
                    </div>
                </form>
            
                <div class="card border-0 py-4">
                    
                    <div class="table-responsive py-2 px-4">
                        <table class="table table-bordered table-hover" width="100%" id="table_hStartupTag">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Tag</th>
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
    </div><!-- end of row -->

    @include('admin.startuptag.substartuptag')
</div>
@include('admin.startuptag.editHstartuptag')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="/js/admin/startuptag.js"></script>
@endsection

