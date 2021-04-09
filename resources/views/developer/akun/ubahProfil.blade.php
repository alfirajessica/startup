
<form action="{{ route('dev.akun.updateAkun')}}" method="POST" enctype="multipart/form-data" id="updateAkun">
  @csrf
<div class="modal fade" id="ubahProfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" name="nama_akunUser" id="nama_akunUser" placeholder="Nama" value="{{$item->name}}"> 
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" placeholder="Regular" class="form-control" name="email_akunUser" disabled value="{{$item->email}}"/>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Provinsi</label>
                  <select class="form-control" name="edit_provinsi_user" id="edit_provinsi_user" onchange="show_cities2(this)">
                    <option value="0" selected>-- pilih provinsi --</option>
                    @foreach($provinces as $provinsi)
                        <option value="{{ $provinsi['province_id'] }}" {{$provinsi['province_id'] == $item->id_province  ? 'selected' : ''}}>{{ $provinsi['province'] }}</option>
                    @endforeach
                </select>
                </div>
              </div>
              <input type="text" name="hidden_province_name" id="hidden_province_name" >
              

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Kota</label>
                  <input type="hidden" name="city_id" id="city_id" value="{{$item->id_city}}">
                  <select class="form-control" name="edit_kota_user" id="edit_kota_user" onchange="get_city()">
                    <option value="0">-- pilih kota --</option>
               </select>
              </div>
              <input type="text" id="hidden_city_name" name="hidden_city_name">
          </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
</form>



<script>
  $(document).ready(function () {
    
  });

  

function show_cities2() {
  
  $('#hidden_province_name').val( $('#edit_provinsi_user option:selected').text());
  
    let provindeId = $('select[name="edit_provinsi_user"]').val();
    console.log("id provinsi :" + provindeId);
    if (provindeId) {
        jQuery.ajax({
            url: '/cities/'+provindeId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('select[name="edit_kota_user"]').empty();
                $('select[name="edit_kota_user"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(response, function (key, value) {
                    var id = value["city_id"];
                    $('select[name="edit_kota_user"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                });
            },
        });
    } else {
        $('select[name="edit_kota_user"]').append('<option value="">-- pilih kota --</option>');
    }
}

function get_city() {  
    $("#hidden_city_name").val($('select[name="edit_kota_user"] option:selected').text());
}

$("#updateAkun").on("submit",function (e) {
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
               //update yang di page akun depan
               $('[name="location_user"]').text($('#hidden_province_name').val()+", " + $('#hidden_city_name').val());
               $('[name="name_user"]').text($('#nama_akunUser').val());
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