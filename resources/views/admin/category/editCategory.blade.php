<form action="{{ route('admin.kategoriProduk.updateCategoryProduct') }}" method="POST" id="editCategoryProduct">
@csrf
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body text-dark">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <form>
              <input type="hidden" id="edit_categoryID" name="edit_categoryID" />
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Kategori Produk :</label>
              <input type="text" class="form-control form-control-alternative text-dark" id="edit_category_product" name="edit_category_product">
              <span class="text-danger error-text edit_category_product_error"></span>
            </div>
          </form>
          <button type="submit" class="btn btn-default float-right">Simpan Perubahan</button>
        </div>
        
      </div>
    </div>
</div>
</form>
