
<form action="{{ route('inv.buatEvent')}}" method="POST" enctype="multipart/form-data" id="buatEvent">
@csrf
<div class="row text-dark">
    <div class="col md-6 ">
        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control form-control-alternative" name="nama_event" aria-describedby="nama_eventHelp" placeholder="Masukkan Nama Event">
            <span class="text-danger error-text nama_event_error"></span>
        </div>

        <div class="form-group">
            <label for="desc_event">Deskripsi Event</label>
            <textarea class="form-control form-control-alternative" name="desc_event" rows="3"></textarea>
            <span class="text-danger error-text desc_event_error"></span>
        </div>

        <div class="form-group">
            <label for="event_held">Event akan diadakan secara</label>
            <select class="form-control form-control-alternative" name="event_held" id="will_beheld" onchange="event_willbe_held()">
                <option value="0" selected disabled> -- Pilih --</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
            <span class="text-danger error-text event_held_error"></span>
        </div>

        <div class="form-group d-none" id="event_link">
            <label for="link_event">Link Event</label>
            <input type="url" class="form-control form-control-alternative" name="link_event" aria-describedby="link_eventHelp" placeholder="Masukkan Link Event" />
            <span class="text-danger error-text link_event_error"></span>
        </div>

        <div class="form-group d-none" id="event_provinsi">
            <label for="provinsi_event">Lokasi provinsi</label>
            <select class="form-control form-control-alternative" name="provinsi_event" onchange="show_cities(this)">
                <option value="0" selected>-- pilih provinsi --</option>
                @foreach($provinces as $provinsi)
                    <option value="{{ $provinsi['province_id'] }}">{{ $provinsi['province'] }}</option>
                @endforeach
            </select>
            <span class="text-danger error-text provinsi_event_error"></span>
        </div>

        <input type="hidden" id="hidden_province_name" name="hidden_province_name">

        <div class="form-group d-none" id="event_kota">
            <label for="kota_event">Lokasi Kota</label>
            <select class="form-control form-control-alternative" name="kota_event" onchange="get_city()">
                 <option value="">-- pilih kota --</option>
            </select>
            <span class="text-danger error-text kota_event_error"></span>
        </div>

        <input type="hidden" id="hidden_city_name" name="hidden_city_name">

        <div class="form-group d-none" id="event_address">
            <label for="address_event">Alamat Event</label>
            <textarea class="form-control form-control-alternative" name="address_event" rows="2"></textarea>
            <span class="text-danger error-text address_event_error"></span>
        </div>
       

    </div>
    <div class="col md-6">
        <div class="form-group">
            <label for="jadwal_event">Jadwal Event</label>
            <input type="date" class="form-control form-control-alternative" name="jadwal_event" aria-describedby="jadwal_eventHelp">
            <span class="text-danger error-text jadwal_event_error"></span>
        </div>

        <div class="form-group">
            <label for="time_event">Jam Event</label>
            <input type="time" class="form-control form-control-alternative" name="time_event" aria-describedby="jadwal_eventHelp">
            <span class="text-danger error-text time_event_error"></span>
        </div>

        {{-- akan di set 1 hari sebelum acara akan ditutup pendaftarannya --}}

        <div class="input-group">
            <label for="exampleInputFile">Poster Event</label>
            <input type="file" class="form-control-file form-control-alternative"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
            <span class="text-danger error-text image_error"></span>
        </div>

        <div class="form-group">
          <a href="#" id="pop">
            {{-- {{asset('images')}} --}}
           
            <img id="previewImg" style="max-width: 250px; margin-top:20px" src="../images/sample-img.png">
            </a>  
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-default float-right">Simpan Event</button>
    </div>
</div>
</form>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Preview Gambar</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
        </div>
        <div class="modal-body">
          <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
        </div>
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script type="text/javascript">

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
