$(function () {
    table_listInvestConfirmYet();
    console.log('masuk');
});


function table_listInvestConfirmYet() { 
    $('#table_listInvestConfirmYet').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/admin/inv/transaksiInv",
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'invest_id',
                render: data => {
                    return "#"+data.invest_id;
                    
                }
              
            },
            {
                data: 'created_at',
                name: 'created_at',
            },
            {
                data: 'jumlah_invest',
                name: 'jumlah_invest',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
              
            },
            {
                data: 'action',
                name: 'action',
            },
            
        ],
       
    });

 }


 $('body').on('click', '.confirmInvest', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Yakin ingin mengkonfirmasi transaksi ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "/admin/inv/transaksiInv/confirmInvest/" + id,
                success: function (data) {
                    table_listInvestConfirmYet();
                    swal("Poof! Transaksi berhasil dikonfirmasi!", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
           
        } else {
            //swal("Your imaginary file is safe!");
        }
    });
});

$('body').on('click', '.notConfirmInvest', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Yakin ingin TIDAK MENGKONFIRMASI transaksi ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "/admin/inv/transaksiInv/notConfirmInvest/" + id,
                success: function (data) {
                    table_listInvestConfirmYet();
                    //jika sukses, call swal
                    swal("Poof! Transaksi tidak dikonfirmasi!", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            
        } else {
          //  swal("Your imaginary file is safe!");
        }
    });
});


$('body').on('click', '.detailProject', function () {
    var id = $(this).data('id');
    projectDetails(id);
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

var getTotal, getUangmuka, temptotal='';
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
            url: "/projectdetailInvest/"  + id,
            type: 'GET',
        },
        
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name_product',
                name: 'name_product',
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