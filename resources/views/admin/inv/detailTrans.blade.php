<style>
  .modal-body {
  max-height: calc(100vh - 210px);
  overflow-y: auto;
  }
  .form-control:disabled{
      background-color:white;
  }
  .table td, .table th
  {
    white-space: initial;
  }
</style>

<div class="modal fade bd-example-modal-lg" id="detailTrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header" style="background-color: #EFEFEF;padding-top: 0.5rem;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="background-color: #EFEFEF;padding-top: 0.5rem;">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" id="project_id">
                <div class="card">
                    <div class="card-body">
                      <strong>Detail Startup/Produk</strong>
                      <div class="table-responsive-lg">
                        <table class="table table-sm padding-0 text-dark" width="100%" id="table_projectDetails">
                            <thead>
                                <th>Invest_id</th>
                                <th>Project</th>
                                <th>Investor</th>
                                <th>Tipe</th>
                                <th>Jumlah (Rp)</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                              <tr>
                                <th colspan="4" style="text-align:right; font-weight:bold">Fee Investasi (Rp) : </th>
                                <th style="text-align:right; font-weight:bold" id="fee"></th>
                              </tr>
                              <tr>
                                  <th colspan="4" style="text-align:right; font-weight:bold">Total Investasi (Rp) : </th>
                                  <th style="text-align:right; font-weight:bold" id="totalsemua"></th>
                              </tr>
                            </tfoot>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row py-4">
          {{-- payment information --}}
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <strong>Detail Investasi pada Startup/Produk</strong>
                <div class="table-responsive-lg">
                  <table class="table table-sm padding-0 text-dark" width="100%" id="table_detailOrder">
                    <tbody>
                      <tr>
                        <td style="padding-left: 0.5rem;" > <strong> Awal Investasi </strong></td>
                        <td style="padding-left: 0rem;"   id='invest_awal'></td>
                      </tr>
                      <tr>
                        <td style="padding-left: 0.5rem;" > <strong> Masa Berlaku Investasi</strong></td>
                        <td style="padding-left: 0rem;"    id='invest_exp'></td>
                      </tr>
                      <tr>
                        <td style="padding-left: 0.5rem;" ><strong> Invest Id</strong></td>
                        <td style="padding-left: 0rem;"    id='invest_id'></td>
                      </tr>
                      <tr>
                          <td style="padding-left: 0.5rem;" > <strong>Transaksi ID</strong></td>
                          <td style="padding-left: 0rem;"    id='transaction_id'></td>
                      </tr>
                      <tr>
                        <td style="padding-left: 0.5rem;" > <strong> Tipe Pembayaran</strong></td>
                        <td style="padding-left: 0rem;"    id='pay_type'></td>
                      </tr>
                      <tr>
                          <td style="padding-left: 0.5rem;" ><strong>Status Investasi</strong></td>
                          <td style="padding-left: 0rem;"    id='msg_admin'></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- end of payment information --}}

          {{-- investor and developer information --}}
          <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <strong>Detail Pembayaran</strong>
                  <div class="table-responsive-lg">
                    <table class="table table-sm padding-0 text-dark" width="100%" id="table_payDetails">
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          {{-- end of investor and developer information --}}
      </div>
        </div> {{--  end modal body --}}
      </div>
    </div>
</div>

