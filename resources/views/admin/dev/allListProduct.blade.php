@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <h3>Produk Terdata</h3>
    <div class="row">
      {{-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2"> --}}
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                {{-- <div class="card"> <!-- card shadow -->  --}}
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_allListProductDev">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Nama Product</th>
                              <th>Status Product</th>
                              <th>Status Investor</th>
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

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  //semua function disini ada pada --> public/js/admin/dev/product/productDev.js

  //call function table --> table_allListProductDev
  const url_table_allListProductDev = @json(route('admin.dev.allListProduct'));


</script>
<script src="/js/admin/dev/listProduct.js"></script>


@endsection