<div class="card border-0 py-2">
    <div class="card-body shadow">
        <h5>Financial</h5>
       
            
        
        <div class="table-responsive">
            <div id="container" style="width:100%; height:400px;"></div>
            <table class="table table-bordered table-hover" width="100%" id="table_finance">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Masuk (Rp)</th>
                    <th>Keluar (Rp)</th>
                    <th>Profit (Rp)</th>
                </tr>
            </thead>
            
            <tbody>
               
                <tr>
                    @foreach ($list_finance as $item1)
                    
                    <td id="year"> {{ \Carbon\Carbon::parse($item1->monthDate)->format('M/Y')}}
                        </td>
                    <td id="revenue"> {{number_format( $item1->total_masuk , 0 , '.' , ',' )}} </td>
                    
                        @foreach ($list_finance_keluar as $item2)
                        <td> {{number_format($item2->total_keluar, 0 , '.' , ',' )}} </td>
                        
                        @endforeach
                        <td> {{number_format($item1->total_masuk - $item2->total_keluar, 0 , '.' , ',' )}}</td>
                    @endforeach
                </tr>
            </tbody>
            
            </table>
            
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

$(document).ready(function () {
    let draw = false;

init();

});


/**
 * FUNCTIONS
 */

 function init() {
  // initialize DataTables
  const table = $("#table_finance").DataTable();
  // get table data
  const tableData = getTableData(table);
  // create Highcharts
  createHighcharts(tableData);
  // table events
  setTableEvents(table);
}

function getTableData(table) {
  const dataArray = [],
    countryArray = [],
    populationArray = [],
    densityArray = [];

  // loop table rows
  table.rows({ search: "applied" }).every(function() {
    const data = this.data();
    countryArray.push(data[0]);
    populationArray.push(parseInt(data[1].replace(/\,/g, "")));
    densityArray.push(parseInt(data[2].replace(/\,/g, "")));
  });

  // store all data in dataArray
  dataArray.push(countryArray, populationArray, densityArray);

  return dataArray;
}

function createHighcharts(data) {
  Highcharts.setOptions({
    lang: {
      thousandsSep: "."
    }
  });

  Highcharts.chart("container", {
    title: {
      text: "DataTables to Highcharts"
    },
    subtitle: {
      text: "Data from worldometers.info"
    },
    xAxis: [
      {
        categories: data[0],
        labels: {
          rotation: -45
        }
      }
    ],
    yAxis: [
      {
        // first yaxis
        title: {
          text: "Masuk (Rp)"
        }
      },
      {
        // secondary yaxis
        title: {
          text: "Keluar (Rp)"
        },
        min: 0,
        opposite: true
      }
    ],
    series: [
      {
        name: "Masuk (Rp)",
        color: "#0071A7",
        type: "line",
        data: data[1],
        
      },
      {
        name: "Keluar (Rp)",
        color: "#FF404E",
        type: "line",
        data: data[2],
        yAxis: 1
      },
      
    ],
    tooltip: {
      shared: true
    },
    legend: {
      backgroundColor: "#ececec",
      shadow: true
    },
    credits: {
      enabled: false
    },
    noData: {
      style: {
        fontSize: "16px"
      }
    }
  });
}

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
</script>