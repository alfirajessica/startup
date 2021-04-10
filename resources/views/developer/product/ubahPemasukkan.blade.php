
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
</script>