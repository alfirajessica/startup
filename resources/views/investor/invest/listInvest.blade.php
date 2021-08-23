{{-- modal detail dari transaksi investasi --}}
@include('investor.invest.detailTrans')
{{-- end of modal detail dari transaksi investasi --}}
<div class="row">
  <div class="col-md-12">
    
  </div>
</div>

<div class="col-md-12 py-2">
    <!-- card -->
    <div class="card">
      <div class="card shadow border-0">
      <div class="card-body"> <!-- card body -->
        <!-- tab content -->
        
        <strong>Cetak Laporan dengan menekan tombol ini </strong>
         <button type="button" class="btn btn-default mx-3" data-toggle="modal" data-target="#exampleModalCenter">
            Cetak Laporan Investasi
         </button>
         <br>
        <div class="tab-content" id="myTabContent">
            <!-- table_listInvestPending -->
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <div class="col-md-12 py-2 px-0">
                  <br>
                  <label class="text-dark">* Tombol <b>Sudah Kirim</b> untuk mengkonfirmasi pengiriman</label> <br>
                  <label class="text-dark">** Tombol <b>Batal Invest</b> untuk membatalkan investasi</label><br>
                  <label class="text-dark">*** Mohon refresh halaman ini jika sudah melakukan pembayaran</label>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInvestPending">
                      <thead>
                          <tr style="text-align: center">
                              <th>Startup/Produk</th>
                              <th>Invest id</th>
                              <th>Status Bayar</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                </div>
            </div>
            <!-- end of table_listInvestPending -->

            <!-- table_listInvestSettlement -->
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
              
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInvestSettlement">
                      <thead>
                          <tr style="text-align: center">
                              <th>Startup/Produk</th>
                              <th>Invest id</th>
                              <th>Status Bayar</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
            </div> 
            <!-- end of table_listInvestSettlementt -->

            <!-- table_listInvestCancel -->
            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInvestCancel">
                      <thead>
                          <tr style="text-align: center">
                            <th>Startup/Produk</th>
                            <th>Invest id</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
            </div>
            <!-- end of table_listInvestCancel -->

            <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
              <div class="table-responsive">
                  <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInvestFinished">
                    <thead>
                        <tr style="text-align: center">
                          <th>Startup/Produk</th>
                          <th>Invest id</th>
                          <th>Status Bayar</th>
                          <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                <!-- AKHIR TABLE -->
                </div>
            </div>
        </div> <!-- end of tab content -->
      </div> <!--end of card body -->
      </div>
    </div>
    <!-- end card -->
</div>

<!-- Modal untuk cetak laporan investasi-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0rem">
        <h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Investasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-dark">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Periode Awal</label>
              <input type="date" name="" id="date_awal" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
              <small id="help_date_awal" class="text-muted"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Periode Akhir</label>
              <input type="date" name="" id="date_akhir" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
              <small id="help_date_akhir" class="text-muted"></small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for=""></label>
              <select class="form-control form-control-alternative" name="" id="select_jenislaporan">
                <option value="0">Semua Investasi</option>
                <option value="1">Investasi Aktif</option>
                <option value="2">Investasi Gagal/Cancel</option>
                <option value="3">Investasi Selesai</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-default float-right" onclick="cetak_riwayatInv()">Cetak Laporan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal beri rating invest-->
<div class="modal fade" id="beri_ratingInvest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form action="{{ route('inv.invest.beriReview')}}" method="POST" enctype="multipart/form-data" id="beriReviewInvestasi">
          @csrf
          <input type="hidden" id="id_headerinvest" name="id_headerinvest">
          <label for="" class="text-dark" style="margin-top: 20px;margin-bottom: auto;"> Beri Penilaian Anda</label>
          <div class='stars' data-rating='0'>
              <span class='star' data-rating='1'>&nbsp;</span>
              <span class='star' data-rating='2'>&nbsp;</span>
              <span class='star' data-rating='3'>&nbsp;</span>
              <span class='star' data-rating='4'>&nbsp;</span>
              <span class='star' data-rating='5'>&nbsp;</span>
          </div>
          <input type="hidden" id="stars_rating" name="stars_rating">
          <span class="text-danger error-text stars_rating_error"></span>
      
          <div class="form-group">
              <label for="" class="text-dark" >Komentar Anda</label>
              <textarea class="form-control" name="isi_review" id="isi_review" rows="3"></textarea>
              <span class="text-danger error-text isi_review_error"></span>
          </div>
          <button type="submit" class="btn btn-default float-right">Beri Penilaian</button>
      </form>
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-cOQK7kRXSSPSVE3Y"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
  //----------------stars rating ----------------------------------//
          //initial setup
          document.addEventListener('DOMContentLoaded', function(){
              let stars = document.querySelectorAll('.star');
              stars.forEach(function(star){
                  star.addEventListener('click', setRating); 
              });
              
              let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
              let target = stars[rating - 1];
              //target.dispatchEvent(new MouseEvent('click'));
          });
  
          function setRating(ev){
              let span = ev.currentTarget;
              let stars = document.querySelectorAll('.star');
              let match = false;
              let num = 0;
              stars.forEach(function(star, index){
                  if(match){
                      star.classList.remove('rated');
                  }else{
                      star.classList.add('rated');
                  }
                  //are we currently looking at the span that was clicked
                  if(star === span){
                      match = true;
                      num = index + 1;
                  }
              });
              document.querySelector('.stars').setAttribute('data-rating', num);
          }
          //----------------end of stars rating ----------------------------------//
  </script>
