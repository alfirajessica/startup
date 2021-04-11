
  <!-- Modal -->
  <form action="{{ route('dev.product.updatePemasukkan')}}" method="POST" id="modal_ubahJumlah">
    @csrf
  <div class="modal fade" id="ubahJumlah"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nama_tipe">nama/tipe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="status_kas" id="status_kas">
          <input type="hidden" name="id_detail_product_kas" id="id_detail_product_kas">
          <label for="">Jumlah baru</label>
          <input type="number" class="form-control form-control-alternative" name="edit_jumlah" id="edit_jumlah">
          <span class="text-danger error-text edit_jumlah_error"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  $(document).ready(function () {
    if ($('#status_kas').val() == "Pemasukkan") {
      table_listPemasukkan();
    }
    else
    {
      table_listPengeluaran();
    }
  });

  $("#modal_ubahJumlah").on("submit",function (e) {
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
                $('#modal_ubahJumlah')[0].reset();
                //$('#modal_ubahJumlah').hide();
                if ($('#status_kas').val() == "Pemasukkan") {
                  table_listPemasukkan();
                }
                else
                {
                  table_listPengeluaran();
                }
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