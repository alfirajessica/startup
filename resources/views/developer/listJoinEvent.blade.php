@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
     <div class="row"> <!-- row -->
        <div class="col-md-12">
          <!-- card -->
          <div class="card border-0">
            <div class="card text-white border-0">
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
  table_listEvent();
  table_listCancleEvent();
  table_listHistoryEvent();
});

var coba="";
//function table list event -- show all event from the user who is login
function table_listEvent() {
    $('#table_listEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.listJoinEvent') }}",
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    
                    var hari = moment(data.event_schedule).format('dddd');
                    if (hari == "Sunday") {
                        hari = "Minggu";
                    }
                    else if (hari == "Monday") {
                        hari = "Senin";
                    }
                    else if (hari == "Tuesday") {
                        hari = "Selasa";
                    }
                    else if (hari == "Wednesday") {
                        hari = "Rabu";
                    }
                    else if (hari == "Thursday") {
                        hari = "Kamis";
                    }
                    else if (hari == "Friday") {
                        hari = "Jumat";
                    }
                    else if (hari == "Saturday") {
                        hari = "Sabtu";
                    }
                    var jadwal = moment(data.event_schedule).format('DD/MMM/YYYY');
                    return hari + ', ' + jadwal+'<br><small>'+data.event_time+'</small><br>';
                }
            },
            {
                data:null,
                name:'id_header_events',
                render: data => {
                    
                    var id = data.id_header_events;
                   
                    return '<a data-original-title="Detail" class="edit btn btn-danger btn-sm" onclick="cancle_join('+id+')" >Batal</a>';
                }
            },
        ],
        
    });
}

function cancle_join(id) { 
    console.log(id);
    var txt;
    swal({
        title: "Are You sure want to cancle join this event?",
        text: "Once cancle, you will not be able to recover this event!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "{{ route('dev.event') }}"+'/cancleEvent' + '/' + id,
                    success: function (data) {
                        table_listEvent();
                        table_listCancleEvent();
                        table_listHistoryEvent();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });

 }

function table_listCancleEvent() {
    $('#table_listcancleEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.listCancleEvent') }}",
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    
                    var hari = moment(data.event_schedule).format('dddd');
                    if (hari == "Sunday") {
                        hari = "Minggu";
                    }
                    else if (hari == "Monday") {
                        hari = "Senin";
                    }
                    else if (hari == "Tuesday") {
                        hari = "Selasa";
                    }
                    else if (hari == "Wednesday") {
                        hari = "Rabu";
                    }
                    else if (hari == "Thursday") {
                        hari = "Kamis";
                    }
                    else if (hari == "Friday") {
                        hari = "Jumat";
                    }
                    else if (hari == "Saturday") {
                        hari = "Sabtu";
                    }
                    var jadwal = moment(data.event_schedule).format('DD/MMM/YYYY');
                    return hari + ', ' + jadwal+'<br><small>'+data.event_time+'</small><br>';
                }
            },
        ],
        
    });
}

function table_listHistoryEvent() {
    $('#table_listHistoryEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.listHistoryEvent') }}",
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    
                    var hari = moment(data.event_schedule).format('dddd');
                    if (hari == "Sunday") {
                        hari = "Minggu";
                    }
                    else if (hari == "Monday") {
                        hari = "Senin";
                    }
                    else if (hari == "Tuesday") {
                        hari = "Selasa";
                    }
                    else if (hari == "Wednesday") {
                        hari = "Rabu";
                    }
                    else if (hari == "Thursday") {
                        hari = "Kamis";
                    }
                    else if (hari == "Friday") {
                        hari = "Jumat";
                    }
                    else if (hari == "Saturday") {
                        hari = "Sabtu";
                    }
                    var jadwal = moment(data.event_schedule).format('DD/MMM/YYYY');
                    return hari + ', ' + jadwal+'<br><small>'+data.event_time+'</small><br>';
                }
            },
        ],
        
    });
}

</script>