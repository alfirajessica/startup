<form method="POST" action="{{ route('') }}">
    @csrf
<div class="row">
    <div class="col md-6">
        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control" id="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
            <small id="nama_eventHelp" class="form-text text-muted">Masukkan Nama Event Anda</small>
        </div>

        <div class="form-group">
            <label for="desc_event">Deskripsi Event</label>
            <textarea class="form-control" id="desc_event" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="event_held">Event akan diadakan secara</label>
            <select class="form-control" id="event_held" onchange="event_willbe_held()">
                <option value="0">pilih</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>

        <div class="form-group d-none" id="event_link">
            <label for="link_event">Link Event</label>
            <input type="url" class="form-control" id="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event">
            <small id="link_eventHelp" class="form-text text-muted">Masukkan Link Meeting : Meet maupun Zoom</small>
        </div>

        <div class="form-group d-none" id="event_lokasi">
            <label for="lokasi_event">Lokasi</label>
            <select class="form-control" id="lokasi_event">
              <option>--</option>
              
            </select>
        </div>

    </div>
    <div class="col md-6">
        <div class="form-group">
            <label for="jadwal_event">Jadwal Event</label>
            <input type="date" class="form-control" id="jadwal_event" aria-describedby="jadwal_eventHelp">
            <small id="jadwal_eventHelp" class="form-text text-muted">Tentukan Jadwal Event Anda</small>
        </div>

        {{-- akan di set 1 hari sebelum acara akan ditutup pendaftarannya --}}

        <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="gambar_event">
              <label class="custom-file-label" for="gambar_event">Cari</label>
            </div>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" id="tampilkan_gambar">Tampilkan</button>
            </div>
        </div>

        <div class="form-group">
          <label for=""></label>
          {{-- <img src="..." alt="..." class="img-thumbnail"> --}}
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
//lakukan hidden ('d-none') dan show dengan jika event held dipilih salah satu
function event_willbe_held() {
    var event_held = $("#event_held").val(); 
    console.log(event_held);
    if (event_held == "online") {
        document.querySelector('#event_link').classList.remove('d-none');
        document.querySelector('#event_lokasi').classList.add('d-none');
    }
    else if (event_held == "offline") {
        document.querySelector('#event_link').classList.add('d-none');
        document.querySelector('#event_lokasi').classList.remove('d-none');
    }
    
}
   
</script>