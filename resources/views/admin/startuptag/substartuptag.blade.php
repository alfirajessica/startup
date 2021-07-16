<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="subStartupTag">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Startup Tag</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form action="{{ route('admin.startupTags.addNewSubStartupTag') }}" method="POST" id="addNewSubStartupTag">
                    @csrf
                    <input type="hidden" id="hStartupID" name="hStartupID"/>
                    <div class="form-group">
                      <label for="detailcategory_product" class="col-form-label">Masukkan Detail Kategori Produk:</label>
                      <div class="input-group input-group-alternative mb-4" >
                          <input type="text" class="form-control" name="sub_nameStartupTag">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                          </div>
                      </div>
                      <span class="text-danger error-text sub_nameStartupTag_error"></span>
                  </div>  
                </form>
              </div> 
            </div>

            <div class="table-responsive py-2">
                <table class="table table-bordered table-hover" width="100%" id="table_subStartupTag">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Sub Tag</th>
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