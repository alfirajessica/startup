<div class="row">
    <div class="col-md-12">
        <h4><strong>List Semua Ulasan Yang Diperoleh </strong></h4>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="listUlasan-tab" data-toggle="tab" href="#listUlasan" role="tab" aria-controls="listUlasan" aria-selected="false">Ulasan</a>
            </li>
        </ul>
        <div class="card">
            
        </div>
        <div class="tab-content py-4 bg-white" id="myTabContent">
            <div class="tab-pane fade show active" id="listUlasan" role="tabpanel" aria-labelledby="listUlasan-tab">
                
                <div class="table-responsive py-2 px-2">
                    <table class="table table-bordered table-hover table_listProduct text-dark" style="width:100%" id="table_listUlasan">
                      <thead style="text-align:center">
                          <tr>
                            <th>#Id</th>
                            <th>Tanggal</th>
                            <th>Investor</th>
                            <th>Rating & Review</th>
                            <th>Tanggapan</th>
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


<form action="{{ route('dev.reviews.postResponse')}}" method="POST" id="modalBeriTanggapan">
    @csrf
  <div class="modal fade" id="modal_BeriTanggapan"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <input type="hidden" id="id_reviews" name="id_reviews">
            <input type="hidden" id="id_response" name="id_response">
            <label for="">Tanggapan Anda</label>
            <textarea class="form-control form-control-alternative" name="beri_response" id="beri_response" rows="3" ></textarea>
            <span class="text-danger error-text beri_response_error"></span>
            <br>
            <button type="submit" class="btn btn-default float-right">Simpan Tanggapan Ini</button>

        </div>
       
      </div>
    </div>
  </div>
</form>