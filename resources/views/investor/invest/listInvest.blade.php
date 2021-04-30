<div class="col-md-12 py-2">
    <!-- card -->
    <div class="card">
      <div class="card shadow">
      <div class="card-body"> <!-- card body -->
        <!-- tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- profile -->
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestAktif">
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
            <!-- end of profile -->

            <!-- password -->
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
              
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestTdkAktif">
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
            </div> <!-- end of lihat daftar event -->

            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="table_listInvestAktif">
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
        </div> <!-- end of tab content -->
      </div> <!--end of card body -->
      </div>
    </div>
    <!-- end card -->
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
    const url_table_listInvestAktif = "{{ route('inv.invest.listInvestAktif') }}" + '/';

    const url_table_listInvestTdkAktif = "{{ route('inv.invest.listInvestTdkAktif') }}" + '/';
</script>

<script src="/js/inv/invest.js"></script>