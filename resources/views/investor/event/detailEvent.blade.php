<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="detailEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-secondary">
        <div class="modal-header">

            <div class="col-md-11">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tab_desc-tab" data-toggle="tab" href="#tab_desc" role="tab" aria-controls="tab_desc" aria-selected="true">Detail Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs_participant-tab" data-toggle="tab" href="#tabs_participant" role="tab" aria-controls="tabs_participant" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Peserta Event</a>
                        </li>
                    </ul>
                </div>
            </div>
        
            <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
        <div class="modal-body">
        <form action="">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab_desc" role="tabpanel" aria-labelledby="tab_desc-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-0">
                                      
                                        <img id="previewImg" class="d-block user-select-none shadow" width="100%" height="200" >
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0">
                                        <div class="card-body shadow">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 id="title_detailevent" ></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 id="held_detailEvent"></h5>
                                                </div>
                                            </div>
                
                                            <div class="row d-none" id="row_link">
                                                <div class="col-12">
                                                    <i class="fas fa-external-link-alt"></i> 
                                                    <a href="" id="link_detailEvent"></a>
                                                </div>
                                            </div>
                
                                            <div class="row d-none" id="row_loc">
                                                <div class="col-12">
                                                    <i class="fas fa-map-marker-alt"></i> 
                                                    <label id="loc_detailEvent"></label> <br>
                                                    <label id="add_detailEvent"></label>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-12">
                                                    <i class="fas fa-calendar-alt "></i> 
                                                    <label id="date_detailEvent">  </label>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-12">
                                                    <i class="fas fa-clock"></i>
                                                    <label id="time_detailEvent"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="form-group px-2">
                                            <h6>Deskripsi</h6>
                                            <p id="desc_detailevent" class="card-text"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs_participant" role="tabpanel" aria-labelledby="tabs_participant-tab">
                            <div class="row py-4">
                                <div class="col">
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover" width="100%" id="table_participant">
                                        <thead>
                                            <tr>
                                                <th>Nama Event</th>
                                                <th>Diadakan Secara</th>
                                                <th>Diadakan Secara</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                      </table>
                                    <!-- AKHIR TABLE -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
</div>

<script>
    //const url_list_participant = "{{ route('inv.listEvent') }}" +'/listParticipant' + '/';
</script>

{{-- <script src="/js/inv/event.js"></script> --}}