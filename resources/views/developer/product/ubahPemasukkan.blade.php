
  <!-- Modal -->
  <form action="{{ route('dev.product.updatePemasukkan')}}" method="POST" id="modal_ubahJumlah">
    @csrf
  <div class="modal fade" id="ubahJumlah"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h5 class="modal-title" id="nama_tipe"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <br>
          <input type="hidden" name="status_kas" id="status_kas">
          <input type="hidden" name="id_detail_product_kas" id="id_detail_product_kas">
          <label for="">Jumlah</label>

          <input type="text" name="edit_jumlah" id="edit_jumlah" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">

          {{-- <input type="number" class="form-control form-control-alternative" name="edit_jumlah" id="edit_jumlah"> --}}
          <span class="text-danger error-text edit_jumlah_error"></span>
          <br>
          <button type="submit" class="btn btn-default float-right">Simpan Perubahan</button>
        </div>
        
      </div>
    </div>
  </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>      
<script src="/js/dev/product.js"></script>
