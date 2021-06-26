<form action="{{ route('admin.updateTypeTrans') }}" method="POST" id="editTypeTrans">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <form>
                  <input type="hidden" id="edit_type_ID" name="edit_type_ID" />
                  <input type="hidden" id="tipeTrans" />
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Keterangan</label>
                  <input type="text" class="form-control" id="edit_type_ket" name="edit_type_ket">
                  <span class="text-danger error-text edit_type_ket_error"></span>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
    </div>
</form>
