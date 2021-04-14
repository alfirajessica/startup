
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailProduct">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
                <div class="col-md-11">
                    <div class="nav-wrapper">
                        <!-- tabs -->
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Transaksi</a>
                            </li>
                        </ul>
                    </div>
                </div>
           
                <div class="col-md-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-0">
                
                                        <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                                        <rect width="100%" height="100%" fill="#868e96"></rect>
                                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                        </svg>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0">
                                        <div class="card-body shadow">
                                            <h5>Event Info</h5>
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 id="nama_product"></h5>
                                                </div>
                                            </div>
                        
                                            <div class="row" id="row_link">
                                                <div class="col-12">
                                                    <i class="fas fa-external-link-alt"></i> 
                                                    <a href="" id="url_product"></a>
                                                </div>
                                            </div>
                        
                                            <div class="row d-none" id="row_loc">
                                                <div class="col-12">
                                                    <i class="fas fa-map-marker-alt"></i> 
                                                    <label id="loc_detailEvent"></label> <br>
                                                    <label id="add_detailEvent"></label>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col-12">
                                                    <i class="fas fa-calendar-alt "></i> 
                                                    <label id="rilis_product">  </label>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col-12">
                                                    <i class="fas fa-clock"></i>
                                                    <label id="time_detailEvent"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6>Deskripsi</h6>
                                        <label for="" id="desc"></label>
                                    </div>
                                    <div class="form-group">
                                        <h6>Team</h6>
                                        <label for="" id="team"></label>
                                    </div>
                                    <div class="form-group">
                                        <h6>Reason</h6>
                                        <label for="" id="reason"></label>
                                    </div>
                                    <div class="form-group">
                                        <h6>Benefit</h6>
                                        <label for="" id="benefit"></label>
                                    </div>
                                    <div class="form-group">
                                        <h6>Solution</h6>
                                        <label for="" id="solution"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" id="table_detailProduct">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Created at</th>
                                          <th>Tipe Trans</th>
                                          <th>Jumlah</th>
                                      </tr>
                                  </thead>
                                  <tbody></tbody>
                                  <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right; font-weight:bold">Total Pemasukkan :</th>
                                        <th style="font-weight:bold"></th>
                                    </tr>
                                    
                                    <tr>
                                        <th colspan="3" style="text-align:right; font-weight:bold">Total Pengeluaran :</th>
                                        <th style="font-weight:bold" id="totalsemua"></th>
                                    </tr>
                                </tfoot>
                                </table>
                              <!-- AKHIR TABLE -->
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
var getTotal, getUangmuka, temptotal='';
//var table = $('#table_detailProduct').DataTable();
function table_detailProduct(id) {
    var groupColumn = 1;
    $('#table_detailProduct').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.listProduct') }}" +'/detailProjectKas' + '/' + id,
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'tipe',
                render: data => {
                    var tipe="";
                    if (data.tipe == "1") {
                        tipe = "+";
                    }else{
                        tipe = "-"
                    }
                    return tipe;
                }
            },
            {
                data: null,
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
              
            },
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            
            //Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                
                .reduce( function (a, b) {
                    
                    var cur_index = api.column(0).data().indexOf(a);
                        if (api.column(0).data()[cur_index] != "1") {
                        return parseInt(a)+parseInt(b);
                    }
                    else { return parseInt(a); }

                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(total)
            );
            
            $("#totalsemua").html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
            );                        
        }
    });
}

</script>