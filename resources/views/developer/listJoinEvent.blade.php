@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row"> <!-- row -->
        <div class="col-md-12">
          <!-- card -->
            <div class="card border-0" style="background-color: #f7f3e9">
                
                <div class="nav-wrapper">
                <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Event diikuti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Event dibatalkan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Riwayat Event</a>
                        </li>
                    </ul>
                </div>
               
          </div>
          
        </div><!-- end card -->

        <div class="col-md-12 py-2">
          <!-- card -->
          <div class="card">
            <div class="card shadow">
            <div class="card-body"> <!-- card body -->
              <!-- tab content -->
              <div class="tab-content" id="myTabContent">
                  <!-- profile -->
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <div class="row py-4">
        
                        <div class="col">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
                                <thead>
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Diadakan Secara</th>
                                        <th>Jadwal Acara</th>
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
                    <div class="row py-4">
        
                        <div class="col">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover" width="100%" id="table_listcancleEvent">
                                <thead>
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Diadakan Secara</th>
                                        <th>Jadwal Acara</th>
                                        
                                    </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                            <!-- AKHIR TABLE -->
                            </div>
                        </div>
                    </div>
                    
                  </div> <!-- end of lihat daftar event -->
                  <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <div class="row py-4">
        
                        <div class="col">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover" width="100%" id="table_listHistoryEvent">
                                <thead>
                                    <tr>
                                        <th>Nama Event</th>
                                        <th>Diadakan Secara</th>
                                        <th>Jadwal Acara</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                            <!-- AKHIR TABLE -->
                            </div>
                        </div>
                    </div>
                
              </div>
              </div> <!-- end of tab content -->

              
            </div> <!--end of card body -->
            </div>
          </div>
          <!-- end card -->
        </div>
      </div>
    
</div>
@endsection



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script>
    const url_table_listEvent = "{{ route('dev.listJoinEvent') }}";
    const url_table_listcancleEvent = "{{ route('dev.listCancleEvent') }}";
    const url_table_listHistoryEvent = "{{ route('dev.listHistoryEvent') }}";
</script>
<script src="/js/dev/listJoinEvent.js">
    
</script>