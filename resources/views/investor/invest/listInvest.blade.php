{{-- modal detail dari transaksi investasi --}}
@include('investor.invest.detailTrans')
{{-- end of modal detail dari transaksi investasi --}}

<div class="col-md-12 py-2">
    <!-- card -->
    <div class="card">
      <div class="card shadow border-0">
      <div class="card-body"> <!-- card body -->
        <!-- tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- table_listInvestPending -->
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <div class="alert alert-info" role="alert">
                  <strong>info</strong> Mohon refresh halaman ini jika sudah melakukan pembayaran
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestPending">
                      <thead>
                          <tr>
                              <th>Invest_id</th>
                              <th>Project</th>
                              <th>Status</th>
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
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestSettlement">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Event</th>
                              <th>Diadakan Secara</th>
                              <th>Jadwal Acara</th>
                             
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
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestCancel">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nama Event</th>
                              <th>Diadakan Secara</th>
                              <th>Jadwal Acara</th>
                             
                          </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
            </div>
            <!-- end of table_listInvestCancel -->
        </div> <!-- end of tab content -->
      </div> <!--end of card body -->
      </div>
    </div>
    <!-- end card -->
</div>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>  
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>
    //tabel listInvestPending --> untuk daftar transaksi investasi yang BELUM dikirim uangnya.
    const url_table_listInvestPending = "{{ route('inv.invest.listInvestPending') }}" + '/';

    //tabel listInvestSettlement --> untuk daftar transaksi investasi yang SUDAH dikirim uangnya.
    const url_table_listInvestSettlement = "{{ route('inv.invest.listInvestSettlement') }}" + '/';

    //tabel listInvestCancel --> untuk daftar transaksi investasi yang DI CANCLE OR EXPIRE 
    const url_table_listInvestCancel= "{{ route('inv.invest.listInvestCancel') }}" + '/';

    const url_detailInvest = '/detailInvest' + '/';
    const url_detailStatusInvest = '/detailStatusInvest' + '/';
    const url_table_projectDetails = '/projectdetailInvest' + '/';

</script>

<script src="/js/inv/invest.js"></script>