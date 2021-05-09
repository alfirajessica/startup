//Dibawah ini adalah function pada inv/startup.blade.php
// Yang termasuk : semua pada folder investor/detailStartup

$(function () {

    //startup.blade.php
    $('#search_input').on('keyup', function() {
        $value = $(this).val();
        getMoreUsers(1);
    });

        // var checkboxes = $('input[name="check_detailCat[]"]');
        // checkboxes.filter(":checked").map(function () {
        //   return this.value;
        // }).get()
    
    //     var typecategory = $('input[name="checkbox_categoryDetail"]:checked').val();
    // console.log(typecategory);

    //var typecategory = $('input[name="check_detailCat"]:checked').val();
    // console.log(typecategory);

    //financial.blade.php
    table_finance();
    
    init();
});
let draw = false;
//startup.blade.php
function getMoreUsers(page) {
    var search = $('#search_input').val();

    var typecategory = $('input[name="category_check"]:checked').val();
    console.log(typecategory);
    
    $.ajax({
      type: "GET",
      data: {
        'search_query':search,
        'typecategory_query':"",
      },
      url: url_get_more_users + page,
      success:function(data) {
        console.log(data);
        if (data == null) {
          $('#user_data').html("kosong");
        } else {
          $('#user_data').html(data);
        }
        
      }
    });
}

//startup.blade.php
function show_detail() { 
    var id = $('#checkbox_categoryHeader').val();
    console.log(id);

    $.get(url_show_detail + id, function (data) {
         //var place = document.getElementById('check-awesome');
        $('div[name="checkbox_categoryDetail"]').empty();
         for (let i = 0; i < data.list_detailcategory.length; i++) {
             console.log(data.list_detailcategory[i]["id"])

             var idnya = data.list_detailcategory[i]["id"];
             var isi = data.list_detailcategory[i]["name"];
                    
             $('div[name="checkbox_categoryDetail"]').append('<label id="typeCategory" class="form-check-label" > <input name="category_check" class="form-check-input border-0"  type="checkbox" value="'+ idnya + '"/>' + isi + '</label> <br>');
        }  
    });
}

//financial.blade.php -- table financial
function table_finance() { 
 
  $('#table_finance').DataTable({
      destroy:true,
      processing: true,
      serverSide: true, //aktifkan server-side 
      responsive:true,
      deferRender:true,
      aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
      ajax: {
          url: 'financial/' + url_table_finance,
          type: 'GET',
      },
      order: [
          [0, 'asc']
      ],
      columns: [
          {
              data: 'id',
              name: 'id',
          },
          {
              data: 'total_masuk',
              name: 'total_masuk',
            
          },
          {
              data: 'total_masuk',
              name: 'total_masuk',
            
          },
          {
              data: 'action',
              name: 'action',
          },
          
      ],
      
  });

}

//financial.blade.php
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

//financial.blade.php
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

//financial.blade.php
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
      },
      responsive: {
          rules: [{
              condition: {
                  maxWidth: 500
              },
              chartOptions: {
                  legend: {
                      align: 'center',
                      verticalAlign: 'bottom',
                      layout: 'horizontal'
                  }
              }
          }]
      }
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