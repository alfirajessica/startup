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
            [0, 'desc']
        ],
        columns: [
            {
                data: null,
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD-MMM-YYYY');
                }
            },
            {
                data: null,
                name: 'invest_id',
                render: data => {
                    return "#"+data.invest_id;                  
                }
            },          
            {
                data: 'jumlah_invest',
                name: 'jumlah_invest',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
              
            },
            {
                data: 'status_transaction',
                name: 'status_transaction',
            },
            {
                data: null,
                name: 'action',
                render: data => {
                    var action="";
                    if (data.status_transaction == "settlement" && data.status_invest == 0) {
                       action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Confirm" class="btn btn-success btn-sm confirmInvest" data-tr="tr_{{$product->id}}">Konfirmasi</a>';

                    }
                    return data.action + action;
                }
            },
        ],
       
    });

 }


 $('body').on('click', '.confirmInvest', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        text: "Yakin Untuk Konfirmasi Transaksi Investasi Ini?",
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
                    swal("Transaksi Investasi Berhasil Dikonfirmasi!", {
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
        text: "Yakin ingin TIDAK MENGKONFIRMASI transaksi ini?",
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
                    swal("Transaksi tidak dikonfirmasi!", {
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
        url: '/admin/inv/transaksiInv/detailInvest' + '/' + id,
        contentType: "application/json",
        success: function (data) {
           console.log(data);
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
        else if (data['payment_type'] == "bca_klikpay") {
            tipe_pay="BCA Klikpay";
        }
        else if (data['payment_type'] == "cstore") {
            tipe_pay="Indomaret";
        }
        else if (data['payment_type'] == "akulaku") {
            tipe_pay="Akulaku";
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
            detail_time_settle = data['transaction_status'] + "<br> " + (moment(data['settlement_time']).format('DD-MMM-YYYY h:mm:ss a'))
        }
        else{
            detail_time_settle = data['transaction_status'];
        }

        if (data['payment_type'] == "credit_card") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong> Bank </strong> </td>" +
                "<td>" + data['bank'].toUpperCase() + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>  <strong> Card  </strong></td>" +
                "<td>" + data['masked_card'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>  <strong>Jumlah Transfer </strong> </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa  </strong></td>" +
                "<td>" + (moment(data['transaction_time']).add(1, 'days').format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "bank_transfer") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Bank </strong></td>" +
                "<td>" + data['va_numbers'][0]['bank'].toUpperCase() + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Virtual Account  </strong></td>" +
                "<td>" + data['va_numbers'][0]['va_number'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Jumlah Transfer  </strong> </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>  <strong> Waktu Kadaluarsa  </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).add(1, 'days').format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>  <strong> Status Pembayaran  </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "echannel") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Bank  </strong></td>" +
                "<td>Mandiri Bill</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Biller Code </strong> </td>" +
                "<td>" + data['biller_code'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Bill Key </strong> </td>" +
                "<td>" + data['bill_key'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Jumlah Transfer  </strong></td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).add(1, 'days').format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "gopay") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Tipe Bayar </strong></td>" +
                "<td>Gopay</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>QR CODE  </strong></td>" +
                "<td><img width='200px' height='200px' class='qr' src='https://api.sandbox.veritrans.co.id/v2/gopay/" + data['transaction_id'] + "/qr-code'> </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Jumlah Transfer  </strong></td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td>Waktu Kadaluarsa </td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td>  <strong> Status Pembayaran  </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "qris") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Tipe Bayar </strong></td>" +
                "<td> " + data['acquirer'] + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>QR CODE  </strong></td>" +
                "<td><img width='200px' height='200px' class='qr' src='https://api.sandbox.veritrans.co.id/v2/qris/shopeepay/sppq_" + data['transaction_id'] + "/qr-code'> </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "bca_klikpay") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Tipe Bayar </strong></td>" +
                "<td> BCA Klikpay </td>" +
            "</tr>" +
            "<tr>" +
            "<td> <strong>Jumlah Transfer  </strong> </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "cstore") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Tipe Bayar </strong></td>" +
                "<td>" + data['store']+" </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Kode Pembayaran </strong></td>" +
                "<td>" + data['payment_code']+" </td>" +
            "</tr>" +
            "<tr>" +
            "<td> <strong>Jumlah Transfer  </strong> </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
                "<td>" + detail_time_settle + "</td>" +
            "</tr>";
            $('#table_payDetails tbody').html(showPayDetail);
        }
        else if (data['payment_type'] == "akulaku") {
            showPayDetail = 
            "<tr>" +
                "<td> <strong>Tipe Bayar </strong></td>" +
                "<td>" + data['payment_type']+" </td>" +
            "</tr>" +
            "<tr>" +
            "<td> <strong>Jumlah Transfer  </strong> </td>" +
                "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Waktu Kadaluarsa </strong> </td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm:ss a')) + "</td>" +
            "</tr>" +
            "<tr>" +
                "<td> <strong>Status Pembayaran </strong></td>" +
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
    url: '/admin/inv/transaksiInv/detailStatusInvest' + '/' + id,
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
            url: "/admin/inv/transaksiInv/projectdetailInvest/"  + id,
            type: 'GET',
        },
        
        columns: [
            {
                data: null,
                name: 'id',
                className: 'dt-body-center',
                render: data => {
                    return "#"+data.id;
                }
            },
            {
                data: 'name_product',
                name: 'name_product',
            },
            {
                data: null,
                name: 'email',
                render: data => {
                    
                    return "<label>" + data.nama_inv +" <br> " + data.email + "</label>";
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