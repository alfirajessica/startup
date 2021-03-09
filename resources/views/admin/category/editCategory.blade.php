<form action="{{ route('admin.updateCategoryProduct') }}" method="POST" id="editCategoryProduct">
@csrf
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kateori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <input type="text" id="edit_categoryID" name="edit_categoryID" />
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Kategori Produk :</label>
              <input type="text" class="form-control" id="edit_category_product" name="edit_category_product">
              <span class="text-danger error-text edit_category_product_error"></span>
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