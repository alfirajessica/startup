@extends('layouts.adm')
<style>
  
</style>
@section('content')
<div class="container">
  
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-12 pt-2 px-2">
        <div class="py-4"></div>
        <div class="row py-4">

            <div class="col-md-3">
              <div class="card-body my-2" style="background-color: white">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">User Investor</h5>
                        @foreach ($count_inv as $item)
                        <span class="h2 font-weight-bold mb-0">{{$item->totalinv}}</span>
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-donate"></i>
                        </div>
                    </div>
                </div>
               
              </div>
            </div>

            <div class="col-md-3">
              <div class="card-body my-2" style="background-color: white">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">User Developer</h5>
                        @foreach ($count_dev as $item)
                        <span class="h2 font-weight-bold mb-0">{{$item->totaldev}}</span>
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </div>
              
              </div>
            </div>

            <div class="col-md-3">
              <div class="card-body my-2" style="background-color: white">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Startup Terdaftar</h5>
                        @foreach ($count_startup as $item)
                        <span class="h2 font-weight-bold mb-0">{{$item->totalstartup}}</span>
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="ni ni-collection"></i>
                        </div>
                    </div>
                </div>
               
              </div>
            </div>

            <div class="col-md-3">
              <div class="card-body my-2" style="background-color: white">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Event Terdaftar</h5>
                        @foreach ($count_event as $item)
                        <span class="h2 font-weight-bold mb-0">{{$item->totalevent}}</span>
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                
              </div>
            </div>
            
            
        </div>
          <div class="row"> <!-- row untuk header categoryProduct -->
            <div class="col-md-7">
              <div id="container" style="width:100%; height:400px;"></div>
              
            </div>
            <div class="col-md-5">
              <div id="container1" style="width:100%; height:400px;"></div>
             
                
              </div>
            </div>
          </div>
      </main>
    </div>
</div>

<div class="table-responsive d-none">
  <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_finance">
  <thead>
      <tr>
          <th>Bln/Thn</th>
          <th>total pendapatan</th>
          
      </tr>
  </thead>
  <tbody>
    @foreach ($get_pendapatan as $item)
      <tr>
        <td id="year"  style="text-align: center;"> {{ \Carbon\Carbon::parse($item->monthDate)->format('M/Y')}}</td>
        <td style="text-align: center;"> {{$item->total}} </td>       
      </tr> 
    @endforeach
  </tbody>
  </table>  
</div>

<div class="table-responsive d-none">
  <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table1">
  <thead>
      <tr>
          <th>Bln/Thn</th>
          <th>Sukses</th>
      </tr>
  </thead>
  <tbody>
   @foreach ($inv_sukses as $item)
       <tr>
        <td id="year"  style="text-align: center;"> {{ \Carbon\Carbon::parse($item->monthDate)->format('M/Y')}}</td>
        <td style="text-align: center;"> {{$item->totalinv_sukses}} </td>   
       </tr>
   @endforeach
  </tbody>
  </table>  
</div>

<div class="table-responsive d-none">
  <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table2">
  <thead>
      <tr>
          <th>Bln/Thn</th>
          <th>Sukses</th>
      </tr>
  </thead>
  <tbody>
   @foreach ($inv_gagal as $item)
       <tr>
        <td id="year"  style="text-align: center;"> {{ \Carbon\Carbon::parse($item->monthDate)->format('M/Y')}}</td>
        <td style="text-align: center;"> {{$item->totalinv_gagal}} </td>   
       </tr>
   @endforeach
  </tbody>
  </table>  
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    $(function () {
      $('#table_finance, #table1, #table2').dataTable({searching: false, info: false, order:true});
      init();
    });

    //financial.blade.php
function init() {
    // initialize DataTables
    const table = $("#table_finance").DataTable();
    const tableData = getTableData(table);
    createHighcharts(tableData);
    setTableEvents(table);

    const table1 = $("#table1").DataTable();
    const table2 = $("#table2").DataTable();
    const tableData1 = getTableData1(table1, table2);
    createHighcharts1(tableData1);
    setTableEvents1(table1, table2);
    
}

//financial.blade.php
function getTableData(table) {
    const dataArray = [],
      countryArray = [],
      populationArray = [],
      densityArray = [];
      settlementArray = [];
  
    // loop table rows
    table.rows({ search: "applied" }).every(function() {
      const data = this.data();
      countryArray.push(data[0]);
      populationArray.push(parseInt(data[1].replace(/\,/g, "")));
    });

    // store all data in dataArray
    dataArray.push(countryArray, populationArray, densityArray, settlementArray);
  
    return dataArray;
}

//financial.blade.php
function getTableData1(table1, table2) {
    const dataArray = [],
      countryArray = [],
      populationArray = [],
      densityArray = [];
      settlementArray = [];

    table1.rows({ search: "applied" }).every(function() {
      const data = this.data();
      countryArray.push(data[0]);
      populationArray.push(parseInt(data[1].replace(/\,/g, "")));
     // densityArray.push(parseInt(data[2].replace(/\,/g, "")));
    });

    table2.rows({ search: "applied" }).every(function() {
      const data = this.data();
      densityArray.push(parseInt(data[1].replace(/\,/g, "")));
    });
  
    // store all data in dataArray
    dataArray.push(countryArray, populationArray, densityArray, settlementArray);
  
    return dataArray;
}

//financial.blade.php
function createHighcharts(data) {
    Highcharts.setOptions({
      lang: {
        thousandsSep: "."
      }
    });
  
    Highcharts.chart('container', {
      
      title: {
        text: "Pendapatan Website"
      },
      yAxis: {
          title: {
              text: 'Jumlah'
          }
      },

      xAxis: [
              {
                categories: data[0],
                labels: {
                  rotation: -45
                }
              }
            ],

      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
      },


      series: [{
          name: 'Pendapatan',
          data: data[1],
      },
       ],
      legend: {
              backgroundColor: "#ececec",
              shadow: true
            },
      responsive: {
          rules: [{
              condition: {
                  maxWidth: 500
              },
              chartOptions: {
                  legend: {
                      layout: 'horizontal',
                      align: 'center',
                      verticalAlign: 'bottom'
                  }
              }
          }]
      }

      });
}

function createHighcharts1(data) {
    
    Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Transaksi Investasi'
    },
    xAxis: [
      {
        categories: data[0],
        labels: {
          rotation: -45
        }
      }
    ],
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Transaksi'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
      {
        name: 'Gagal',
        color: "#de622c",
        
        data:  data[2]

    }, {
        name: 'Berhasil',
        color: "#34eb7a",
        data: data[1]

    }, ]
});
}

//financial.blade.php
function setTableEvents(table) {
    // listen for page clicks
    table.on("page", () => {
      draw = true;
    });
  
    // listen for updates and adjust the chart accordingly
    table.on("draw", () => {
      if (draw) {
        draw = false;
      } else {
        const tableData = getTableData(table);
        createHighcharts(tableData);
      }
    });
}

function setTableEvents1(table1, table2) {
    table1.on("page", () => {
      draw = true;
    });
   

    table1.on("draw", () => {
      if (draw) {
        draw = false;
      } else {
        const tableData = getTableData1(table1, table2);
        createHighcharts1(tableData1);
      }
    });

   
}
</script> 
@endsection

