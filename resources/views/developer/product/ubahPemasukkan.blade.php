
  <!-- Modal -->
  <form action="{{ route('dev.product.updatePemasukkan')}}" method="POST" id="modal_ubahJumlah">
    @csrf
  <div class="modal fade" id="ubahJumlah"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nama_tipe"></h5>
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
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="/js/dev/product.js"></script>
