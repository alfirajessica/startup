
$(function () {
    $('#invest_number').val(0);
   // updStatusTrans();
    listInvest();
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
       $('#notif_invest_number').html('minimal 500 Ribu Rupiah (500.000)!');
    }
    else {
        swal({
            text: "Apakah Anda Yakin untuk Investasi Startup ini Sekarang?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((WillConfirm) => {
            if (WillConfirm) {
                
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
                            
                            window.snap.pay(data, {
                               onSuccess: function(result){
                                 /* You may add your own implementation here */
                                 alert("payment success!"); console.log(result);
                               },
                               onPending: function(result){
                                 //updStatusTrans();
                                 window.location.href = "/inv/invest";
                               },
                               onError: function(result){
                                 /* You may add your own implementation here */
                                 alert("payment failed!"); console.log(result);
                               },
                               onClose: function(){
                                 //window.location.href = "/inv/invest";
                               }
                             })
                        }
                       
                       },
                       error: function (data) {
                           console.log('Error:', data);
                       }
           
                   });
            } else {
                
            }
        });

        
    }

} 

function updStatusTrans() { 
    $.ajax({
        type: "get",
        url: "/updStatus",
        success: function (data) {
           // listInvest();
           console.log('update');
          
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
// end of product/desc.blade.php

// invest/listinvest.blade.php
function listInvest() { 
    //updStatusTrans();
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
                        btn= "<a href='javascript:void(0)' data-toggle='modal' data-target='#detailTrans' data-id='"+ data.id + "' data-original-title='Detail' class='detail btn btn-warning btn-sm detailProject' id='table_listInvestPending' style='text-transform:none'>Detail</a>";

                        btn = btn + " <a href='javascript:void(0)' data-toggle='tooltip' data-id='" + data.id + "' data-original-title='Kirim' class='btn btn-success btn-sm sudahKirim' data-tr='tr_{{$product->id}}' style='text-transform:none' >Sudah Kirim</a>";
                    
                        btn = btn + " <a href='javascript:void(0)' data-toggle='tooltip' data-id='" + data.id + "' data-original-title='Cancel' class='btn btn-danger btn-sm cancelInvest' data-tr='tr_{{$product->id}}' style='text-transform:none' >Batal Invest</a>";
                    }
                    else if (data.status_transaction == "settlement") {
                        btn= "<a href='javascript:void(0)' data-toggle='modal' data-target='#detailTrans' data-id='"+ data.id + "' data-original-title='Detail' class='detail btn btn-warning btn-sm detailProject' style='text-transform:none'>Detail</a>";
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
                data: null,
                name: 'action', 
                render: data => {

                    if (data.status_review == "0") {
                        $("#id_headerinvest").val(data.id);
                        return data.action + ' <a href="javascript:void(0)" data-toggle="modal" data-target="#beri_ratingInvest"  data-id="'+data.id+'" data-original-title="rating" class="edit btn btn-primary btn-sm beriRatingInvest" style="text-transform:none">Beri Penilaian</a>';
                    }else{
                        return data.action;
                    }
                    
                }
                
            },
        ],
        
    });
}


$('body').on('click', '.detailProject', function () {
    moment.locale('id');
    var id = $(this).data('id');
    var cekTabel = $(this).attr("id");
    console.log(cekTabel);

    $("#detailInv-tab").addClass('active');
    $("#lapfinance-tab").addClass('d-none');

    if (cekTabel == "table_listInvestCancel" || cekTabel == "table_listInvestPending") {
       
        $("#detailInv-tab").addClass('active');
        $("#detailInv").addClass('show active');

        $("#lapfinance-tab").removeClass('show active');
        $("#lapfinance").removeClass('show active').addClass('d-none');
        
    }
    if (cekTabel == "table_listInvestFinished" || cekTabel == "table_listInvestSettlement") {
        $("#detailInv-tab").addClass('active');
        $("#detailInv").addClass('show active');

        $("#lapfinance-tab").removeClass('d-none');
        $("#lapfinance").removeClass('d-none').removeClass('show active');
        
    }

    $("#project_id").val(id);
    projectDetails(id);

    table_lapFinance(id);

    $.ajax({
        type: "get",
        url: '/detailInvest' + '/' + id,
        contentType: "application/json",
        success: function (data) {
           console.log(data);
            var tipe_pay = "";

            if(data == 0){
                $.ajax({
                    type: "get",
                    url: '/detailInvest/midtransdata/' + id ,
                    contentType: "application/json",
                    success: function (data) {
                        console.log('midtransdata');
                        $('#invest_id').text(data['id']); 
                        $('#pay_type').text('Bank Transfer');
                         
                        showPayDetail = 
                        "<tr>" +
                            "<td> <strong>Bank </strong></td>" +
                            "<td>" + data['bank'] + "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td> <strong>Virtual Account  </strong></td>" +
                            "<td>" + data['va_numbers']+ "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td> <strong>Jumlah Transfer  </strong> </td>" +
                            "<td> Rp" + Number(data['gross_amount']).toLocaleString(['ban', 'id']) + ",00 </td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>  <strong> Waktu Kadaluarsa  </strong> </td>" +
                            "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>  <strong> Status Pembayaran  </strong></td>" +
                            "<td>" + data['transaction_status'] + "<br> " + (moment(data['settlement_time']).format('DD-MMM-YYYY h:mm'))+ "</td>" +
                        "</tr>";
                        $('#table_payDetails tbody').html(showPayDetail);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            }else{
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
                else if (data['payment_type'] == "qris") {
                    tipe_pay="ShopeePay";
                }
            }

        
        
        $('#invest_id').text(data['order_id']);    
        $('#pay_type').text(tipe_pay);
        //$('#transaction_id').text(data['transaction_id']);
        
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
            detail_time_settle = data['transaction_status'] + "<br> " + (moment(data['settlement_time']).format('DD-MMM-YYYY h:mm'))
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
                "<td>" + (moment(data['transaction_time']).add(1, 'days').format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).add(1, 'days').zone('+0100').format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).add(1, 'days').format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td> <strong> Waktu Kadaluarsa </strong></td>" +
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
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
                "<td>" + (moment(data['transaction_time']).format('DD-MMM-YYYY h:mm')) + "</td>" +
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
    listInvest();
});

$('body').on('click', '.cancelInvest', function () {
    var id = $(this).data('id');
    //console.log(id);
    swal({
        text: "Apakah yakin ingin membatalkan investasi?",
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
                    listInvest();
                    swal("Investasi berhasil dibatalkan", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
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
                data: 'invest_id',
                name: 'invest_id'
            },
            {
                data: null,
                name: 'name_product',
                render: data => {
                    $("#proyek_nama, #proyek").text(data.name_product);
                    var btndownload_proposal="";
                    var btndownload_contract="";
                    
                    if (data.file_proposal != "" || data.file_proposal != null) {
                        btndownload_proposal = "<a target='_blank' class='btn btn-icon btn-3 btn-default text-white btn-sm my-2' type='button' id='file_proposal' href='/inv/startup/detailstartup/downloadfile1/"+data.file_proposal+"'><span class='btn-inner--text'>Proposal</span><span class='btn-inner--icon'><i class='fas fa-download'></i></span></a>";
                    }else if (data.file_proposal == null || data.file_proposal == "") {
                        btndownload_proposal="-";
                    }

                    if (data.file_contract != "" || data.file_contract != null) {
                        btndownload_contract = "<a target='_blank' class='btn btn-icon btn-3 btn-default text-white btn-sm my-2' type='button' id='file_kontrak' href='/inv/startup/detailstartup/downloadfile2/" + data.file_contract+"'><span class='btn-inner--text'>Kontrak </span><span class='btn-inner--icon'><i class='fas fa-download'></i></span></a> <br>";
                    }
                    else if (data.file_contract == null || data.file_contract == "") {
                        btndownload_contract="-";
                    }

                    return data.name_product + "<br>" + btndownload_proposal + btndownload_contract;
                    
                }
            },
            {
                data: null,
                name: 'email',
                render: data => {
                    return "<label>" + data.nama_dev +" <br> " + data.email + "<br> " + data.no_telp + "</label>";
                }
            },
            {
                data: 'name',
                name: 'name',
                
                
            },
            {
                data: 'jumlah_invest',
                name: 'jumlah_invest',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, '' )
              
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
                $.fn.dataTable.render.number('.',',','2','').display(fee)
            ); 

            $("#totalsemua").html(
                $.fn.dataTable.render.number('.',',','2','').display(getTotal)
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
    var $masuk, $keluar,$totalakhir, $temptotalakhir, $totalmasuk,$totalkeluar = 0;

    $('#table_pemasukkan_inv').DataTable({
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
                className: 'dt-body-center',
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
                name: 'tanggal',
                render: data => {
                    return moment(data.tanggal).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, '')
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
                    return intVal(a) + intVal(b);
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
                $.fn.dataTable.render.number('.',',','2','').display(total)
            );                 
        }
        
    });

    $('#table_pengeluaran_inv').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        language: {
            "emptyTable": "Belum ada data pengeluaran oleh Startup"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/detailFinance/" + id,
            type: 'GET',
            data:{
                "getTabel":"#table_pengeluaran_inv",
            },
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'tipe',
                className: 'dt-body-center',
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
                name: 'tanggal',
                render: data => {
                    return moment(data.tanggal).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, '')
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
                    return intVal(a) + intVal(b);
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
                $.fn.dataTable.render.number('.',',','2','').display(total)
            );                 
        }
    });

    
    
  }


  function btn_d_lapFinanceInv() { 
      var id = $("#project_id").val();
      window.open("/inv/report/cetak_keuanganStartup/"+id);
   }

   function cetak_riwayatInv() { 
        var dateawal = $("#date_awal").val();
        var dateakhir = $("#date_akhir").val();
        var piljenisLap = $("#select_jenislaporan").val();

        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/inv/report/cetak_riwayatInv/"+dateawal+"/"+dateakhir+"/"+piljenisLap);
        } 
    }

    $("#beriReviewInvestasi").on("submit",function (e) {
        var rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
        $("#stars_rating").val(rating);
       
        e.preventDefault();
       
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function() {
                $(document).find('span.error-text').text('');
            },
            success:function(data) {
                if (data == 1) {
                    listInvest();
                    reset_form();
                    $("#beri_ratingInvest").modal('hide');
                    swal("Terima Kasih atas Penilaian Anda", {
                        icon: "success",
                    });
                }
                else{
                    
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                    
                }
            }
        });
    });

    function reset_form() { 
        $("#isi_review").val('');
        
        $(".stars").removeAttr('rated');
       document.querySelector('.stars').getAttribute('data-rating').value = '0';
    }
// end of invest/listinvest.blade.php