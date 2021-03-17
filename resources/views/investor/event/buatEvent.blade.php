<form action="{{ route('inv.buatEvent')}}" method="POST" enctype="multipart/form-data" id="buatEvent">
@csrf
<div class="row">
    <div class="col md-6">
        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control" name="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
            <span class="text-danger error-text nama_event_error"></span>
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
            <input type="url" class="form-control" name="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event" />
            <span class="text-danger error-text link_event_error"></span>
        </div>

        <div class="form-group d-none" id="event_provinsi">
            <label for="provinsi_event">Lokasi provinsi</label>
            <select class="form-control" name="provinsi_event" onchange="show_cities(this)">
                <option value="0" selected>-- pilih provinsi --</option>
                @foreach($provinces as $provinsi)
                    <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                @endforeach
            </select>
            <span class="text-danger error-text provinsi_event_error"></span>
        </div>

        <input type="text" id="hidden_province_name" name="hidden_province_name">

        <div class="form-group d-none" id="event_kota">
            <label for="kota_event">Lokasi Kota</label>
            <select class="form-control" name="kota_event"onchange="get_city()">
                 <option value="">-- pilih kota --</option>
            </select>
            <span class="text-danger error-text kota_event_error"></span>
        </div>

        <input type="text" id="hidden_city_name" name="hidden_city_name">

        <div class="form-group d-none" id="event_address">
            <label for="address_event">Alamat Event</label>
            <textarea class="form-control" name="address_event" rows="2"></textarea>
            <span class="text-danger error-text address_event_error"></span>
        </div>
       

    </div>
    <div class="col md-6">
        <div class="form-group">
            <label for="jadwal_event">Jadwal Event</label>
            <input type="date" class="form-control" name="jadwal_event" aria-describedby="jadwal_eventHelp">
            <span class="text-danger error-text jadwal_event_error"></span>
        </div>

        <div class="form-group">
            <label for="time_event">Jam Event</label>
            <input type="time" class="form-control" name="time_event" aria-describedby="jadwal_eventHelp">
            <span class="text-danger error-text time_event_error"></span>
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


<script type="text/javascript">

//do hide and show if event_held had choosen -- onchange select
function event_willbe_held() {
    var event_held = $("#will_beheld, #edit_will_beheld").val(); 
    console.log(event_held);
    if (event_held == "online") {
        document.querySelector('#event_link').classList.remove('d-none');
        document.querySelector('#event_provinsi').classList.add('d-none');
        document.querySelector('#event_kota').classList.add('d-none');
        document.querySelector('#event_address').classList.add('d-none');
       
    }
    else if (event_held == "offline") {
        document.querySelector('#event_link').classList.add('d-none');
        document.querySelector('#event_provinsi').classList.remove('d-none');
        document.querySelector('#event_kota').classList.remove('d-none');
        document.querySelector('#event_address').classList.remove('d-none');
    }
}

//show cities when province selected
function show_cities() {
    $("#hidden_province_name").val($('select[name="provinsi_event"] option:selected').text());

    let provindeId = $('select[name="provinsi_event"]').val();
    if (provindeId) {
        jQuery.ajax({
            url: '/cities/'+provindeId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="kota_event"]').empty();
                $('select[name="kota_event"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(response, function (key, value) {
                    var id = value["city_id"];
                    $('select[name="kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                });
                
            },
        });
    } else {
        $('select[name="kota_event"]').append('<option value="">-- pilih kota --</option>');
    }
}

function get_city() {  
    $("#hidden_city_name").val($('select[name="kota_event"] option:selected').text());
}

//to show image what user had choosen in preview
function previewFile() {
    var file = $("#exampleInputFile").get(0).files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
            console.log(file);
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
    console.log($('select[name="kota_event"]').val());
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
                $('#buatEvent')[0].reset();
                document.querySelector('#event_link, #event_lokasi').classList.add('d-none');
                $("#previewImg").attr("src", '{{asset('images')}}');
                table_listEvent(); //call table_listEvent ini listEvent.blade.php
                swal("Berhasil!", data.msg, "success");
                
            }
        }
    });
});

</script>