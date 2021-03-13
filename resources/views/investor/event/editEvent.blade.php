
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('inv.listEvent.updateEvent')}}" method="POST" enctype="multipart/form-data" id="updateEvent">
                @csrf
                <input type="hidden" id="coba_id" name="coba_id" />
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
                            <select class="form-control" name="edit_provinsi_event" id="edit_provinsi_event" onchange="show_cities2(this)">
                                <option value="0" selected>-- pilih provinsi --</option>
                                @foreach($provinces as $provinsi)
                                    <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text edit_provinsi_event_error"></span>
                        </div>
                
                        <div class="form-group d-none" id="events_kota">
                            <label for="kota_event">Lokasi Kota</label>
                            <select class="form-control" name="edit_kota_event" id="edit_kota_event">
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
                            <label for="editInputFile2">File input</label>
                            <input type="file" class="form-control-file"  name="image" id="editInputFile2" aria-describedby="fileHelp" onchange="previewFile2(this)">
                            <span class="text-danger error-text image_error"></span>
                        </div>
                
                        <div class="form-group">
                          <a href="#" id="pop">
                            <img id="previewImg2" style="max-width: 250px; margin-top:20px" src="{{asset('images')}}">
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


<script>
    $(document).ready(function () {
        console.log($('select[name="edit_kota_event"]').val());
        
    });
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

function previewFile2() {
    var file = $("#exampleInputFile2").get(0).files[0];
    console.log(file);
    if (file) {
        var reader = new FileReader();
        reader.onload = function(){
            $("#previewImg2").attr("src", reader.result);
            console.log(file);
        }
        reader.readAsDataURL(file);
    }
}

//show cities when province selected
function show_cities2() {
    let provindeId = $('select[name="edit_provinsi_event"]').val();
    console.log("id provinsi :" + provindeId);
    if (provindeId) {
        jQuery.ajax({
            url: '/cities/'+provindeId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="edit_kota_event"]').empty();
                $('select[name="edit_kota_event"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(response, function (key, value) {
                    var id = value["city_id"];
                    $('select[name="edit_kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                });
            },
        });
    } else {
        $('select[name="edit_kota_event"]').append('<option value="">-- pilih kota --</option>');
    }
}

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