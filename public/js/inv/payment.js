//all function in this js for payment method -- using Midtrans

//document.getElementById('pay-button').onclick = function ()
$(function () {
    $('#invest_number').val(0)
});
function payButton() {
    console.log('ok');
   
    var id=$('#id_product').text();

    var num = $('#invest_number').val().toLocaleString().replace(/\D/g,'');
    var invest=parseInt(num);
    console.log(invest);
    //batas minimal invest 500 ribu
    if (invest < 500000) {
       $('#notif_invest_number').html('minimal 500 ribu!');
    }
    else {
        $.ajax({
        type: "GET",
        url: url_pay + id + '/' + invest,
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