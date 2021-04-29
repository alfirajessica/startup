$(function () {
    $('#invest_number').val(0);
    listInvestAktif();
    listInvestTdkAktif();
});

// product/desc.blade.php  --> saat user menekan tombol Investasikan pada modal
function payButton() {
    console.log('ok');
   
    var id=$('#id_product').text();
    var nama_project = $('#name_project').text();

    var num = $('#invest_number').val().toLocaleString().replace(/\D/g,'');
    var invest=parseInt(num);
    
    //batas minimal invest 500 ribu
    if (invest < 500000) {
       $('#notif_invest_number').html('minimal 500 ribu!');
    }
    else {
        $.ajax({
        type: "GET",
        url: url_pay + id + '/' + invest,
        data:{
            "nama_project":nama_project,
            },
        success:function(data) {
            console.log(data);
            $('#invest_number').val(0);
            snap.pay(data, {
            // Optional
            onSuccess: function(result){
                
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
            });
        }
    });
    }

} 
// end of product/desc.blade.php

// invest/listinvest.blade.php
function listInvestAktif() {
    $('#table_listInvestAktif').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listInvestAktif,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
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
                data: 'name',
                name: 'name',
              
            },
            {
                data: 'action',
                name: 'action',
              
            },
            
        ],
        
    });
}

function listInvestTdkAktif() {
    $('#table_listInvestTdkAktif').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listInvestAktif,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
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
                data: 'name',
                name: 'name',
              
            },
            {
                data: 'action',
                name: 'action',
              
            },
            
        ],
        
    });
}
// end of invest/listinvest.blade.php