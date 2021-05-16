@extends('layouts.adm')

@section('content')
<div class="container-fluid">
  <h3>Daftar Developer</h3>
    <div class="row">
      {{-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2"> --}}
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                {{-- <div class="card"> <!-- card shadow -->  --}}
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listDev">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
      {{-- </main> --}}
    </div>
</div>
{{-- 

@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
      <div class="row"> <!-- row -->
        <div class="col-md-12">
          <!-- card -->
          <div class="card">
            <div class="card-header border-1 text-white">
              <div class="nav-wrapper">
                  <!-- tabs -->
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Daftar Developer</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Produk</a>
                      </li>
                  </ul>
              </div>
            </div>
          </div>
          <!-- end card -->
        </div>

        <div class="col-md-12 py-2">
          <!-- card -->
          <div class="card">
            <div class="card-body"> <!-- card body -->
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                      <div class="row">
                          <div class="col">
                            <div class="table-responsive">
                              <table class="table table-bordered table-hover" width="100%" id="table_listDev">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                            <!-- AKHIR TABLE -->
                            </div>
                          </div>
                      </div>
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                      <div class="row">
                          <div class="col">
                              
                          </div>
                      </div>
                  </div> <!-- end of lihat daftar event -->
              </div> <!-- end of tab content -->
          </div> <!--end of card body -->
          </div>
          <!-- end card -->
        </div>
      </div>
</div> --}}
@include('admin.dev.detailDev')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
<script>
  //call function table --> url_table_listDev
  const url_table_listDev = @json(route('admin.dev.listDev'));
</script>
<script src="/js/admin/dev/listDev.js"></script>
@endsection

