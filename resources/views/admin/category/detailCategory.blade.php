<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="detailCategorySub">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding-bottom: 0rem;">
          <h5 class="modal-title" id="title_kategori">List Subkategori</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-dark" style="padding-top: 0rem;">
            <div class="row">
              <div class="col-md-12">
                <form action="{{ route('admin.kategoriProduk.addNewDetailCategoryProduct') }}" method="POST" id="addNewDetailCategoryProduct">
                    @csrf
                    <input type="hidden" id="categoryID" name="categoryID"/>
                    <div class="form-group">
                      <label for="detailcategory_product" class="col-form-label">Masukkan Subkategori Produk:</label>
                      <div class="input-group input-group-alternative mb-4" >
                          <input type="text" class="form-control" name="detailcategory_product" placeholder="masukkan sub kategori baru disini">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">Tambahkan</button>
                          </div>
                      </div>
                      <span class="text-danger error-text detailcategory_product_error"></span>
                  </div>  
                </form>
              </div> 
            </div>

            <div class="table-responsive py-2">
                <table class="table table-bordered table-hover text-dark" width="100%" id="table_detailcategory">
                <thead>
                    <tr style="text-align: center">
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