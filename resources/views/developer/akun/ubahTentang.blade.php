<form action="{{ route('dev.akun.updateTentang')}}" method="POST" enctype="multipart/form-data" id="ubahTentang">
  @csrf
<!-- Modal -->
<div class="modal fade" id="ubahTentangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" >{{$item->desc}}</textarea>
          </div>

          <div class="form-group">
            <label for="">Tim anda</label>
            <textarea class="form-control" name="team" id="exampleFormControlTextarea1" rows="3" >{{$item->team}}</textarea>
          </div>

          <div class="form-group">
            <label for="">Keuntungan</label>
            <textarea class="form-control" name="benefit" id="exampleFormControlTextarea1" rows="3" >{{$item->benefit}}</textarea>
          </div>

          <div class="form-group">
            <label for="">Target</label>
            <textarea class="form-control" name="target" id="exampleFormControlTextarea1" rows="3">{{$item->target}}</textarea> 
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $("#ubahTentang").on("submit",function (e) {
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
               location.reload();
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