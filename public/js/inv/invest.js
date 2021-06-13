$(function () {
    $('#invest_number').val(0);
    listInvest();
    updStatusTrans();
    investPassed();
    
});

// product/desc.blade.php  --> saat user menekan tombol Investasikan pada modal
function payButton() {
    console.log('ok');
   
    var id=$('#id_product').text();
    var nama_project = $('#name_project').text();

    var num = $('#invest_number').val().toLocaleString().replace(/\D/g,'');
    var invest=parseInt(num);
    
    var durasi = $('#durasi_inv').val();
    var startdate = new Date();
    var invest_exp_date = moment(startdate, "DD-MM-YYYY").add(durasi, 'months').format('YYYY-MM-DD');
    
    //batas minimal invest 500 ribu
    if (invest < 500000) {
       $('#notif_invest_number').html('minimal 500 ribu!');
    }
    else {
         $.ajax({
         type: "GET",
         url: url_pay + id + '/' + invest,
         contentType: "application/json",
         data:{
             "nama_project":nama_project,
             "invest_exp_date":invest_exp_date
             },
         success:function(data) {
             console.log('ini data : ' + data);

             if (data == 0) {
               
                 swal("Gagal!", "Anda belum melunaskan investasi pada project yang sama!", "fail");
               
             }else{
                 $('#invest_number').val(0);
                 $('#exampleModal').modal('hide');
                 updStatusTrans();
                 snap.pay(data, {
                 // Optional
                 onSuccess: function(result){
                     
                     document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                 },
                 // Optional
                 onPending: function(result){
                    // updStatusTrans();
                     document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                 },
                 // Optional
                 onError: function(result){
                     //updStatusTrans();
                     //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                 }
                 });

             }
            
         },
         error: function (data) {
             console.log('Error:', data);
         }

    });
    }

} 

function updStatusTrans() { 
    $.ajax({
        type: "get",
        url: '/updStatus',
        contentType: "application/json",
        success: function (data) {
            listInvest();
          
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
// end of product/desc.blade.php

// invest/listinvest.blade.php
function listInvest() { 
    
    $('#table_listInvestPending').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/inv/invest/listInvestPending/",
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'invest_id',
                name: 'invest_id',
              
            },
            {
                data: 'status_transaction',
                name: 'status_transaction',
              
            },
            {
                data: null,
                name: 'status_transaction', 
                render: data => {
                    var btn;
                    if (data.status_transaction == "pending") {
                        btn= "<a href='javascript:void(0)' data-toggle='modal' data-target='#detailTrans' data-id='"+ data.id + "' data-original-title='Detail' class='detail btn btn-warning btn-sm detailProject'>Detail</a>";

                        btn = btn + " <a href='javascript:void(0)' data-toggle='tooltip' data-id='" + data.id + "' data-original-title='Kirim' class='btn btn-success btn-sm sudahKirim' data-tr='tr_{{$product->id}}' >Sudah Kirim</a>";
                    
                        btn = btn + " <a href='javascript:void(0)' data-toggle='tooltip' data-id='" + data.id + "' data-original-title='Cancel' class='btn btn-danger btn-sm cancelInvest' data-tr='tr_{{$product->id}}' >Batal Invest</a>";
                    }
                    else if (data.status_transaction == "settlement") {
                        btn= "<a href='javascript:void(0)' data-toggle='modal' data-target='#detailTrans' data-id='"+ data.id + "' data-original-title='Detail' class='detail btn btn-warning btn-sm detailProject'>Detail</a>";
                    }
                    return btn;
                }
            },
           
        ],
        
    });

    $('#table_listInvestSettlement').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/inv/invest/listInvestSettlement/",
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'invest_id',
                name: 'invest_id',
              
            },
            {
                data: 'status_transaction',
                name: 'status_transaction',
              
            },
            {
                data: 'action',
                name: 'action', 
            },
            
        ],
        
    });

    $('#table_listInvestCancel').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/inv/invest/listInvestCancel/",
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'invest_id',
                name: 'invest_id',
              
            },
            {
                data: 'status_transaction',
                name: 'status_transaction',
              
            },
            {
                data: 'action',
                name: 'action', 
            },
        ],
        
    });

    $('#table_listInvestFinished').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/inv/invest/listInvestFinished",
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'invest_id',
                name: 'invest_id',
              
            },
            {
                data: 'status_transaction',
                name: 'status_transaction',
              
            },
            {
                data: 'action',
                name: 'action', 
            },
        ],
        
    });
}


$('body').on('click', '.detailProject', function () {
    var id = $(this).data('id');
    $("#project_id").val(id);
    projectDetails(id);

   
    table_lapFinance(id);


    $.ajax({
        type: "get",
        url: '/detailInvest' + '/' + id,
        contentType: "application/json",
        success: function (data) {
            var tipe_pay = "";

        if (data['payment_type'] == "bank_transfer") {
            tipe_pay="Bank Transfer";
        }
        else if (data['payment_type'] == "credit_card") {
            tipe_pay="Credit card";
        }
        else if (data['payment_type'] == "gopay") {
            tipe_pay="Gopay";
        }
        else if (data['payment_type'] == "echannel") {
            tipe_pay="Mandiri Bill";
        }

        
        
        $('#invest_id').text(data['order_id']);    
        $('#pay_type').text(tipe_pay);
        $('#transaction_id').text(data['transaction_id']);
        
        //Card   --> payment_type:credit_card , masked-card
        //Go-pay --> payment_type:gopay, 
        //Permata --> payment_type:bank_transfer, permata_va_number
        //BCA VA --> payment_type:bank_transfer, data['va_numbers'][0]['bank'] 
        //BNI VA --> payment_type:bank_transfer, data['va_numbers'][0]['bank'] 
        //Mandiri Bill --> payment_type:echannel, bill_key
        //BCA KLICKPAY --> payment_type:bca_klikpay, 
        //KlikBCA --> payment_type:bca_klikbca, 
        //Mandiri clickpay --> --> payment_type:mandiri_clickpay,
        
        var showPayDetail ="";
        var detail_time_settle="";
        if (data['transaction_status'] == "settlement") {
            detail_time_settle = data['transaction_status'] + "<br> " + data['settlement_time'];
        }
        else{
            detail_time_settle = data['transaction_status'];
        }

        if (data['payment_type'] == "credit_card") {
            showPayDetail = 
            "<tr>" +
                "<td>Bank</td>" +
                "<td>" + data['bank'].toUpperCase() + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Card </td>" +
                "<td>" + data['masked_card'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Jumlah Transfer </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Time </td>" +
                "<td>" + data['transaction_time'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Status</td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "bank_transfer") {
            showPayDetail = 
            "<tr>" +
                "<td>Bank</td>" +
                "<td>" + data['va_numbers'][0]['bank'].toUpperCase() + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Virtual Account </td>" +
                "<td>" + data['va_numbers'][0]['va_number'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Jumlah Transfer </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Time </td>" +
                "<td>" + data['transaction_time'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Status</td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "echannel") {
            showPayDetail = 
            "<tr>" +
                "<td>Bank</td>" +
                "<td>Mandiri Bill</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Bill Key </td>" +
                "<td>" + data['bill_key'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Jumlah Transfer </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Time </td>" +
                "<td>" + data['transaction_time'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Status</td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "gopay") {
            showPayDetail = 
            "<tr>" +
                "<td>Tipe Bayar</td>" +
                "<td>Gopay</td>" +
            "</tr>" +
            "<tr>" +
                "<td>QR CODE </td>" +
                "<td><img width='200px' height='200px' class='qr' src='https://api.sandbox.veritrans.co.id/v2/gopay/" + data['transaction_id'] + "/qr-code'> </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Jumlah Transfer </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Time </td>" +
                "<td>" + data['transaction_time'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Status</td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "qris") {
            showPayDetail = 
            "<tr>" +
                "<td>Tipe Bayar</td>" +
                "<td> " + data['acquirer'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>QR CODE </td>" +
                "<td><img width='200px' height='200px' class='qr' src='https://api.sandbox.veritrans.co.id/v2/qris/shopeepay/sppq_" + data['transaction_id'] + "/qr-code'> </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Time </td>" +
                "<td>" + data['transaction_time'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>Status</td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

   //get status_invest
    $.ajax({
        type: "get",
        url: '/detailStatusInvest' + '/' + id,
        contentType: "application/json",
        success: function (data) {
            $('#invest_awal').text(moment(data['created_at']).format('DD-MMM-YYYY'));
            $('#invest_exp').text(moment(data['invest_expire']).format('DD-MMM-YYYY')); 

            $('#invest_awal_m').text(moment(data['created_at']).format('MMM-YYYY'));
            $('#invest_exp_m').text(moment(data['invest_expire']).format('MMM-YYYY')); 
            

            if (data['status_invest'] == "0") {
                $('#msg_admin').text('Menunggu Konfirmasi Admin');
            }else if (data['status_invest'] == "1") {
                $('#msg_admin').text('Telah Dikonfirmasi Admin');
            }
            else if (data['status_invest'] == "2") {
                $('#msg_admin').text('Investasi telah dinonaktifkan');
            }
            else if (data['status_invest'] == "4") {
                $('#msg_admin').text('Investasi Gagal');
            }
            else if (data['status_invest'] == "5") {
                $('#msg_admin').text('Selesai');
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
    
    
});

$('body').on('click', '.sudahKirim', function () {
    updStatusTrans();
});

$('body').on('click', '.cancelInvest', function () {
    var id = $(this).data('id');
    //console.log(id);
    swal({
        title: "Apakah yakin ingin membatalkan investasi?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: '/cancleInvest/' + id ,
                contentType: "application/json",
                success: function (data) {
                    updStatusTrans();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            swal("Investasi berhasil dibatalkan", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });

    
});

var getTotal, fee, temptotal='';
function projectDetails(id) {
    $('#table_projectDetails').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        searching:false,
        paging:false,
        ordering:false,
        info:false,
        ajax: {
            url: '/projectdetailInvest' + '/'  + id,
            type: 'GET',
        },
        
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: null,
                name: 'name_product',
                render: data => {
                    $("#proyek_nama, #proyek").text(data.name_product);
                    return data.name_product;
                    
                }
            },
            {
                data: null,
                name: 'email',
                render: data => {
                    return "<label>" + data.nama_dev +" <br> " + data.email + "</label>";
                }
            },
            {
                data: 'name',
                name: 'name',
                
                
            },
            {
                data: 'jumlah_invest',
                name: 'jumlah_invest',
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            fee = ((total * 1)/100);
            getTotal = total - fee;
            $("#fee").html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(fee)
            ); 

            $("#totalsemua").html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(getTotal)
            );                        
        }
        
    });
}

function investPassed() { 
    $.ajax({
        type: "get",
        url: '/investPassed',
        // contentType: "application/json",
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

//rekap, pemasukkan dan pengeluaran berdasrkan bulan
function table_lapFinance(id) {
    console.log(id);
    var $masuk, $keluar,$totalakhir, $temptotalakhir= 0;
    
    $.ajax({
        type: "get",
        url: '/totalpemasukkan/' + id,
        contentType: "application/json",
        success: function (data) {
            $masuk = data.table_pemasukkan_inv[0]['total_masuk'];
            $totalmasuk = Number(data.table_pemasukkan_inv[0]['total_masuk'].toLocaleString(['ban', 'id'])) + ",00";
            $('#total_masuk').html("Rp"+$totalmasuk);
            $.ajax({
                type: "get",
                url: '/totalpengeluaran/' + id,
                contentType: "application/json",
                success: function (data) {
                    $keluar = data.table_pengeluaran_inv[0]['total_keluar'];
                    $totalkeluar = Number(data.table_pengeluaran_inv[0]['total_keluar'].toLocaleString(['ban', 'id'])) + ",00";
                    $('#total_keluar').html("Rp"+$totalkeluar);

                    $totalakhir = $masuk-$keluar;
                    $temptotalakhir = $totalakhir;
                    $("#total_akhir").html("Rp"+$totalakhir);
                   
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
        
    });

   
    $('#table_pemasukkan_inv').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: 'Data Laporan Startup', //filename
                footer:true,
                header:true,
            },
            {
                extend: 'pdfHtml5',
                messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            }
        ],
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        language: {
            "emptyTable": "Belum ada data pemasukkan oleh Startup"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/detailFinance/" + id,
            type: 'GET',
            data:{
                "getTabel":"#table_pemasukkan_inv",
            },
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
                data: null,
                name: 'jumlah',
                render: data => {
                    var jumlah="";
                    if (data.tipe == "1") {
                        jumlah = data.jumlah;
                    }else{
                        jumlah = "-"
                    }
                    return $.fn.dataTable.render.number( '.', ',', 2, 'Rp').display(jumlah);
                }
               
            },
            {
                data: null,
                name: 'jumlah',
                render: data => {
                    var jumlah="";
                    if (data.tipe == "2") {
                        jumlah = data.jumlah;
                    }else{
                        jumlah = "-"
                    }
                    return $.fn.dataTable.render.number( '.', ',', 2, 'Rp').display(jumlah);
                }
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                render: data => {
                    return "";
                }
            },
            
        ], 
    });

    
    
  }


  function btn_d_lapFinanceInv() { 
      var id = $("#project_id").val();
      window.open("/inv/report/cetak_keuanganStartup/"+id);
   }
// end of invest/listinvest.blade.php