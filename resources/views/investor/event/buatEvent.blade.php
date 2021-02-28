<form action="{{ route('inv.buatEvent')}}" method="POST" enctype="multipart/form-data" id="buatEvent">
    @csrf
<div class="row">
    <div class="col md-6">
        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control" name="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
            <span class="text-danger error-text nama_event_error"></span>
            {{-- <small id="nama_eventHelp" class="form-text text-muted">Masukkan Nama Event Anda</small> --}}
        </div>

        <div class="form-group">
            <label for="desc_event">Deskripsi Event</label>
            <textarea class="form-control" name="desc_event" rows="3"></textarea>
            <span class="text-danger error-text desc_event_error"></span>
        </div>

        <div class="form-group">
            <label for="event_held">Event akan diadakan secara</label>
            <select class="form-control" name="event_held" id="will_beheld" onchange="event_willbe_held()">
                <option value="0">pilih</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
            <span class="text-danger error-text event_held_error"></span>
        </div>

        <div class="form-group d-none" id="event_link">
            <label for="link_event">Link Event</label>
            <input type="url" class="form-control" name="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event">
            {{-- <span class="text-danger error-text link_event_error"></span> --}}
        </div>

        <div class="form-group d-none" id="event_lokasi">
            <label for="lokasi_event">Lokasi</label>
            <select class="form-control" name="lokasi_event">
              <option>--</option>
              
            </select>

        </div>

    </div>
    <div class="col md-6">
        <div class="form-group">
            <label for="jadwal_event">Jadwal Event</label>
            <input type="date" class="form-control" name="jadwal_event" aria-describedby="jadwal_eventHelp">
            <span class="text-danger error-text jadwal_event_error"></span>
        </div>

        {{-- akan di set 1 hari sebelum acara akan ditutup pendaftarannya --}}

        <div class="input-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
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
        <button type="submit" class="btn btn-primary float-right">Simpan Event</button>
    </div>
</div>
</form>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
        </div>
        <div class="modal-body">
          <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
//do hide and show if event_held had choosen -- onchange select
function event_willbe_held() {
    var event_held = $("#will_beheld").val(); 
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

//to show image what user had choosen in preview
function previewFile() {
    var file = $("#exampleInputFile").get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
}

//show image preview to modal
$("#pop").on("click", function() {
    $('#imagepreview').attr('src', $('#previewImg').attr('src')); // here asign the image to the modal when the user click the enlarge link
    $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
});

//function when user click button --Simpan Event
$("#buatEvent").on("submit",function (e) {
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
            }else{
                $('#buatEvent')[0].reset();
                document.querySelector('#event_link, #event_lokasi').classList.add('d-none');
                $("#previewImg").attr("src", '').hide();
                alert(data.msg);
            }
        }
    });
});

</script>