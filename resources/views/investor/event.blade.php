@extends('layouts.inv')
<style>
  .scroll {
  max-height: 400px;
  overflow-y: auto;
}
</style>
@section('content')
<div class="container">
    
     <!-- card shadow -->
      <div class="row"> <!-- row -->
        <div class="col-md-12">
          <div class="nav-wrapper">
              <!-- tabs -->
              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><strong>Buka Event Baru </strong></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><strong>Semua Event Saya</strong></a>
                  </li>
              </ul>
          </div>
        </div>

        <div class="col-md-12 py-2">
          <!-- card -->
          <div class="card">
            <div class="card shadow">
            <div class="card-body border-0"> <!-- card body -->
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                      @include('investor.event.buatEvent')
                  </div>
                  <!-- end of profile -->
      
                  <!-- password -->
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    
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

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="/js/inv/event.js"></script>
<script src="../js/custom.js"></script>
<script type="text/javascript" src="../js/tawk.js"></script>
@endsection

