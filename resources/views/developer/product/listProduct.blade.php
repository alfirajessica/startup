<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Project Terdaftar Aktif</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Project Terdaftar Tidak Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Project memiliki Investor</a>
            </li>
        </ul>
        <div class="tab-content py-4" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="alert alert-info" role="alert">
                    <strong>Project Terdaftar Aktif</strong> adalah project yang ditampilkan pada katalog Startup
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProduct">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Proyek</th>
                              <th>Kategori</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProductNonAktif">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Proyek</th>
                              <th>Kategori</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table_listProduct" width="100%" id="table_listProductInvestor">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Proyek</th>
                              <th>Kategori</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
        </div>
    </div>
    

    {{-- <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Proyek</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div> --}}
</div>

@include('developer.product.detailProduct')



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
{{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script> --}}

<script>
    //semua function disini ada pada --> public/js/dev/listproduct.js

    //call function pada tabel --> table_listProduct --> tab Project Terdaftar Aktif
    const url_table_listProduct = @json(route('dev.listProduct'));

    //call function pada tabel --> table_listProduct /deleteProject
    const url_table_listProduct_deleteProject = "{{ route('dev.listProduct') }}"+'/deleteProject' + '/';

    //call function pada tabel --> table_listProduct /detailProject
    const url_table_listProduct_detailProject = "{{ route('dev.listProduct') }}" +'/detailProject' + '/';

    //call function pada tabel --> table_listProduct /aktifProject
    const url_table_listProduct_activeProject = "{{ route('dev.listProduct') }}" +'/activeProject' + '/';

    //call function pada tabel --> table_listProduct /aktifProject
    const url_table_listProduct_nonactiveProject = "{{ route('dev.listProduct') }}" +'/nonactiveProject' + '/';
 
</script>
<script src="/js/dev/listproduct.js"></script>