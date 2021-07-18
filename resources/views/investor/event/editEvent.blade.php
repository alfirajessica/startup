
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" style="background-color: #EFEFEF">
        <div class="modal-header">
            <div class="col-md-11">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active font-weight-bold" id="tab_desc-tab" data-toggle="tab" href="#tab_desc" role="tab" aria-controls="tab_desc" aria-selected="true">Detail Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 font-weight-bold" id="tabs_participant-tab" data-toggle="tab" href="#tabs_participant" role="tab" aria-controls="tabs_participant" aria-selected="false">Peserta Event</a>
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
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active text-dark" id="tab_desc" role="tabpanel" aria-labelledby="tab_desc-tab">
                            <form action="{{ route('inv.listEvent.updateEvent')}}" method="POST" enctype="multipart/form-data" id="updateEvent">
                                @csrf
                                <input type="hidden" id="coba_id" name="coba_id" />
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label for="edit_nama_event">Nama Event</label>
                                            <input type="text" class="form-control form-control-alternative" name="edit_nama_event" id="edit_nama_event" aria-describedby="edit_nama_eventHelp" placeholder="Masukkan Nama Event">
                                            <span class="text-danger error-text edit_nama_event_error"></span>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="edit_desc_event">Deskripsi Event</label>
                                            <textarea class="form-control form-control-alternative" name="edit_desc_event" id="edit_desc_event" rows="3"></textarea>
                                            <span class="text-danger error-text edit_desc_event_error"></span>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="edit_event_held">Event akan diadakan secara</label>
                                            <select class="form-control form-control-alternative" name="edit_event_held" id="edit_will_beheld" onchange="edit_event_willbe_held()">
                                                <option value="0" disabled>-- Pilih --</option>
                                                <option value="Online">Online</option>
                                                <option value="Offline">Offline</option>
                                            </select>
                                            <span class="text-danger error-text edit_event_held_error"></span>
                                        </div>
                                
                                        <div class="form-group d-none" id="events_link">
                                            <label for="edit_link_event">Link Event</label>
                                            <input type="url" class="form-control form-control-alternative" name="edit_link_event" id="edit_link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event" />
                                            <span class="text-danger error-text edit_link_event_error"></span>
                                        </div>
                                
                                        <div class="form-group d-none" id="events_provinsi">
                                            <label for="edit_provinsi_event">Lokasi provinsi</label>
                                            <select class="form-control form-control-alternative" name="edit_provinsi_event" id="edit_provinsi_event" onchange="show_cities2(this)">
                                                <option value="0" selected>-- pilih provinsi --</option>
                                                @foreach($provinces as $provinsi)
                                                    <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text edit_provinsi_event_error"></span>
                                        </div>
                                
                                        <div class="form-group d-none" id="events_kota">
                                            <label for="kota_event">Lokasi Kota</label>
                                            <select class="form-control form-control-alternative" name="edit_kota_event" id="edit_kota_event">
                                                 <option value="0">-- pilih kota --</option>
                                            </select>
                                            <span class="text-danger error-text kota_event_error"></span>
                                        </div>
                                
                                        <div class="form-group d-none" id="events_address">
                                            <label for="edit_address_event">Alamat Event</label>
                                            <textarea class="form-control form-control-alternative" name="edit_address_event" id="edit_address_event" rows="2"></textarea>
                                            <span class="text-danger error-text edit_address_event_error"></span>
                                        </div>
                                    </div>
                
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label for="edit_jadwal_event">Jadwal Event</label>
                                            <input type="date" class="form-control form-control-alternative" name="edit_jadwal_event" id="edit_jadwal_event" aria-describedby="edit_jadwal_eventHelp">
                                            <span class="text-danger error-text edit_jadwal_event_error"></span>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="edit_time_event">Jam Event</label>
                                            <input type="time" class="form-control form-control-alternative" name="edit_time_event" id="edit_time_event" aria-describedby="edit_time_eventHelp">
                                            <span class="text-danger error-text edit_time_event_error"></span>
                                        </div>
                                
                                        {{-- akan di set 1 hari sebelum acara akan ditutup pendaftarannya --}}
                                
                                        <div class="input-group">
                                            <label for="editInputFile2">File input</label>
                                            <input type="file" class="form-control-file form-control-alternative"  name="image" id="editInputFile2" aria-describedby="fileHelp" onchange="previewFile2(this)">
                                            <span class="text-danger error-text image_error"></span>
                                        </div>
                                
                                        <div class="form-group">
                                          <a href="#" id="pop">
                                            <img id="previewImg2" style="max-width: 250px; margin-top:20px" src="../images/sample-img.png">
                                            </a>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-default float-right">Simpan Perubahan Detail Event</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tabs_participant" role="tabpanel" aria-labelledby="tabs_participant-tab">
                           
                                <strong>Cetak Laporan dengan menekan tombol ini</strong>
                                <button type="button" class="btn btn-default mx-4" onclick="cetak_participantEvent()">
                                  Cetak Peserta Event Ini
                                </button>
                            
                            <div class="row py-4">
                                <div class="card col">
                                  <div class="table-responsive px-2 pt-2">
                                      
                                      <label for="" >Jumlah Peserta Bergabung : <strong id="jumlah_join"> </strong> Peserta</label>
                                      <table class="table table-bordered table-hover" width="100%" id="table_participant">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Peserta</th>
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

            
        </div>
      </div>
    </div>
</div>


<script>
   
//function when user click button -- Simpan perubahan
$("#updateEvent").on("submit",function (e) {
    e.preventDefault();
   
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function() {
            $(document).find('span.error-text').text('');
        },
        success:function(data) {
            if (data.status == 0) {
                $.each(data.error, function (prefix, val) {
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
            else{
                $('#updateEvent')[0].reset();
                document.querySelector('#event_link, #event_lokasi').classList.add('d-none');
                $("#previewImg2").attr("src", '{{asset('images')}}');
                $('#editEventModal').modal('hide');
                table_listEvent(); //call table_listEvent ini listEvent.blade.php
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "success",
                    button: "Aww yiss!",
                });
               
            }
        }
    });
});
</script>
{{-- <script src="/js/inv/event.js"></script> --}}