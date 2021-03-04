<div class="row">
    <div class="col-md-12 card shadow border-0">
        <div class="collapse" id="collapseExample">
            <div class="card-body border-0">
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Tutup
                </a>
                <form action="" method="POST" enctype="multipart/form-data" id="editEvent">
                    @csrf
                    <input type="hidden" id="coba_id" />
                    <div class="row">
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="nama_event">Nama Event</label>
                                <input type="text" class="form-control" name="nama_event" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
                                <span class="text-danger error-text nama_event_error"></span>
                            </div>
                    
                            <div class="form-group">
                                <label for="desc_event">Deskripsi Event</label>
                                <textarea class="form-control" name="desc_event" id="desc_event" rows="3"></textarea>
                                <span class="text-danger error-text desc_event_error"></span>
                            </div>
                    
                            <div class="form-group">
                                <label for="event_held">Event akan diadakan secara</label>
                                <select class="form-control" name="event_held" id="edit_will_beheld" onchange="edit_event_willbe_held()">
                                    <option value="0">pilih</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                                <span class="text-danger error-text event_held_error"></span>
                            </div>
                    
                            <div class="form-group d-none" id="events_link">
                                <label for="link_event">Link Event</label>
                                <input type="url" class="form-control" name="link_event" id="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event" />
                                <span class="text-danger error-text link_event_error"></span>
                            </div>
                    
                            <div class="form-group d-none" id="events_provinsi">
                                <label for="provinsi_event">Lokasi provinsi</label>
                                <select class="form-control" name="provinsi_event" id="provinsi_event" onchange="show_cities(this)">
                                    <option value="0" selected>-- pilih provinsi --</option>
                                    @foreach($provinces as $provinsi)
                                        <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text provinsi_event_error"></span>
                            </div>
                    
                            <div class="form-group d-none" id="events_kota">
                                <label for="kota_event">Lokasi Kota</label>
                                <select class="form-control" name="kota_event" id="kota_event">
                                     <option value="0">-- pilih kota --</option>
                                </select>
                                <span class="text-danger error-text kota_event_error"></span>
                            </div>
                    
                            <div class="form-group d-none" id="events_address">
                                <label for="address_event">Alamat Event</label>
                                <textarea class="form-control" name="address_event" id="address_event" rows="2"></textarea>
                                <span class="text-danger error-text address_event_error"></span>
                            </div>
                           
                    
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label for="jadwal_event">Jadwal Event</label>
                                <input type="date" class="form-control" name="jadwal_event" id="jadwal_event" aria-describedby="jadwal_eventHelp">
                                <span class="text-danger error-text jadwal_event_error"></span>
                            </div>
                    
                            <div class="form-group">
                                <label for="time_event">Jam Event</label>
                                <input type="time" class="form-control" name="time_event" id="time_event" aria-describedby="jadwal_eventHelp">
                                <span class="text-danger error-text time_event_error"></span>
                            </div>
                    
                            {{-- akan di set 1 hari sebelum acara akan ditutup pendaftarannya --}}
                    
                            <div class="input-group">
                                <label for="editInputFile">File input</label>
                                <input type="file" class="form-control-file"  name="image" id="editInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
                                <span class="text-danger error-text image_error"></span>
                            </div>
                    
                            <div class="form-group">
                              <a href="#" id="pop">
                                <img id="previewImg" style="max-width: 250px; margin-top:20px" src="{{asset('images')}}">
                                </a>  
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
    function edit_event_willbe_held() {
    var event_held = $("#edit_will_beheld").val(); 
   
    if (event_held == "Online") {
        document.querySelector('#events_link').classList.remove('d-none');
        document.querySelector('#events_provinsi').classList.add('d-none');
        document.querySelector('#events_kota').classList.add('d-none');
        document.querySelector('#events_address').classList.add('d-none');
       
    }
    else if (event_held == "Offline") {
        document.querySelector('#events_link').classList.add('d-none');
        document.querySelector('#events_provinsi').classList.remove('d-none');
        document.querySelector('#events_kota').classList.remove('d-none');
        document.querySelector('#events_address').classList.remove('d-none');
    }
}

</script>