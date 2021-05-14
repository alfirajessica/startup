<div class="modal fade bd-example-modal-lg" id="detailTrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          {{-- <h5 class="modal-title" id="exampleModalLabel">Ubah Event</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Project Details</div>
                        <div class="card-body">
                          <div class="table-responsive-lg">
                            <table class="table table-sm padding-0" width="100%" id="table_projectDetails">
                                <thead>
                                    <th>Invest_id</th>
                                    <th>Project</th>
                                    <th>Dev</th>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                  <tr>
                                    <th colspan="4" style="text-align:right; font-weight:bold">Fee Investasi</th>
                                    <th style="font-weight:bold">1%</th>
                                  </tr>
                                    <tr>
                                        <th colspan="4" style="text-align:right; font-weight:bold">Total Investasi :</th>
                                        <th style="font-weight:bold" id="totalsemua"></th>
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
                    <div class="card-header">Invest Details</div>
                    <div class="card-body">
                      <div class="table-responsive-lg">
                        <table class="table table-sm padding-0" width="100%" id="table_detailOrder">
                          <tbody>
                            <tr>
                              <td>Masa Berlaku Investasi</td>
                              <td id='invest_exp'></td>
                            </tr>
                            <tr>
                              <td>Invest Id</td>
                              <td id='invest_id'></td>
                            </tr>
                            <tr>
                                <td>Transaksi ID</td>
                                <td id='transaction_id'></td>
                            </tr>
                            <tr>
                              <td>Tipe Pembayaran</td>
                              <td id='pay_type'></td>
                            </tr>
                            <tr>
                                <td>Status Investasi</td>
                                <td id='msg_admin'></td>
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
                      <div class="card-header">Payment Details</div>
                      <div class="card-body">
                        <div class="table-responsive-lg">
                          <table class="table table-sm padding-0" width="100%" id="table_payDetails">
                            <tbody></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
                {{-- end of investor and developer information --}}
            </div>
            
        </div>
        {{-- <div class="modal-footer">
          <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Kirim" class="btn btn-danger btn-sm sudahKirim" data-tr="tr_{{$product->id}}" >Sudah Kirim</a>
        </div> --}}
      </div>
    </div>
  </div>

