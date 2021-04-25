@extends('layouts.adm')

@section('content')
<div class="container-fluid">
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card shadow"> <!-- card shadow --> 
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listProductConfirmYet">
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
</div>        
@include('admin.dev.detailProduct')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  //semua function disini ada pada --> public/js/admin/dev/product/productDev.js

  //call function table --> table_listProductConfirmYet
  const url_table_listProductConfirmYet = @json(route('admin.dev.listProductDev'));

  //call function tabel --> table_listProductConfirmYet /detailProject
  const url_table_listProductConfirmYet_detailProject = "{{ route('admin.dev.listProductDev') }}" +'/detailProject' + '/';

  //call function pada tabel --> table_listProduct /aktifProject
  const url_table_listProductConfirmYet_confirmProject = "{{ route('admin.dev.listProductDev') }}" +'/confirmProject' + '/';

  // //call function pada tabel --> table_listProduct /aktifProject
  const url_table_listProductConfirmYet_notConfirmProject = "{{ route('admin.dev.listProductDev') }}" +'/notConfirmProject' + '/';

</script>
<script src="/js/admin/dev/product/productDev.js"></script>


@endsection
