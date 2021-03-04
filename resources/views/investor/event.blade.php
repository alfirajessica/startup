@extends('layouts.inv')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
      <div class="row"> <!-- row -->
        <div class="col-md-12">
          <!-- card -->
          <div class="card">
            <div class="card-header shadow text-white">
              <div class="nav-wrapper">
                  <!-- tabs -->
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Buka Event Baru</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Event Saya</a>
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
            <div class="card shadow">
            <div class="card-body"> <!-- card body -->
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                      @include('investor.event.buatEvent')
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    @include('investor.event.editEvent')
                    @include('investor.event.listEvent')
                  </div> <!-- end of lihat daftar event -->
              </div> <!-- end of tab content -->
            </div> <!--end of card body -->
            </div>
          </div>
          <!-- end card -->
        </div>
      </div>
</div>
@endsection

