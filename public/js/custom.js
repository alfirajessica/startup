
$(function () {
    event_hasPassed();
    updStatusTrans();
    investPassed();

});

//function dimana akan mengubah status pada tabel header_events
//jika header telah melewati masa akan diadakan event
function event_hasPassed() {  
    $.ajax({
        type: "get",
        url: '/eventPassed',
        success: function (data) {
            console.log('ok');
           
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });


}

  function updStatusTrans() { 
   // console.log('ini result : ' + $id);
    $.ajax({
        type: "get",
        url: '/updStatus',
        success: function (data) {
           // listInvestAktif();
           console.log('upd');
        },
        error: function (data) {
            console.log('Error:', data);
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