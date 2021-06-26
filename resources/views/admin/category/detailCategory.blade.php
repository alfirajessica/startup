<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="detailCategorySub">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Kategori Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{ route('admin.addNewDetailCategoryProduct') }}" method="POST" id="addNewDetailCategoryProduct">
                    @csrf
                    <input type="hidden" id="categoryID" name="categoryID"/>
                    <div class="form-group">
                      <label for="detailcategory_product" class="col-form-label">Masukkan Detail Kategori Produk:</label>
                      <div class="input-group input-group-alternative mb-4" >
                          <input type="text" class="form-control" name="detailcategory_product">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                          </div>
                      </div>
                      <span class="text-danger error-text detailcategory_product_error"></span>
                  </div>  
                </form>
              </div> 
            </div>

            <div class="table-responsive py-2">
                <table class="table table-bordered table-hover" width="100%" id="table_detailcategory">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Sub kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                </table>
                <!-- AKHIR TABLE -->
            </div>
        </div>

      </div>
    </div>
</div>