<form action="{{ route('admin.startupTags.updateHStartupTag') }}" method="POST" id="editHStartupTag">
    @csrf
    <div class="modal fade" id="editHStartupTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            
            <div class="modal-body">
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <form>
                  <input type="hidden" id="edit_HStartupTagID" name="edit_HStartupTagID" />
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Startup Tag :</label>
                  <input type="text" class="form-control" id="edit_HStartupTag" name="edit_HStartupTag">
                  <span class="text-danger error-text edit_HStartupTag_error"></span>
                </div>
              </form>
              <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
            </div>
            
          </div>
        </div>
    </div>
</form>
    