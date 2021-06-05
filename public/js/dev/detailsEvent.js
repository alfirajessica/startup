$(function () {
    held_detailEvent();
});

function held_detailEvent() {
    var event_held = $("#held_detailEvent").text(); 

    if (event_held == "Online") {
        document.querySelector('#row_link').classList.remove('d-none');
        document.querySelector('#row_loc').classList.add('d-none');
        
    }
    else if (event_held == "Offline") {
        document.querySelector('#row_link').classList.add('d-none');
        document.querySelector('#row_loc').classList.remove('d-none');
    }
}

function joinEvent() {
    var id = $("input[name='id_event']").val();
    $.ajax({
        type: "GET",
        url: "/dev/event/joinEvent/" + id,
        success:function(data) 
        {
            if (data == 0) {
                swal("Gagal!", "Anda sudah ikut event ini", "warning");
            }
            else if (data == 1) {
                swal("Berhasil!", "Anda berhasil join Event kembali", "success");
            }else{
                swal("Berhasil!", "Anda berhasil join Event", "success");
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }

   });
   
}
// $("#joinEvent").on("submit",function (e) {
//     e.preventDefault();

//     $.ajax({
//         url:$(this).attr('action'),
//         method:$(this).attr('method'),
//         data:new FormData(this),
//         processData:false,
//         dataType:'json',
//         contentType:false,
//         beforeSend:function() {
//             $(document).find('span.error-text').text('');
//         },
//         success:function(data) {
//             if (data == "0") {
//                 swal({
//                     title: data.msg,
//                     text: "You clicked the button!",
//                     icon: "warning",
//                     button: "Aww yiss!",
//                 });
//             }
//             if (data.status == -1) {
//                 // $.each(data.error, function (prefix, val) {
//                 //     $('span.'+prefix+'_error').text(val[0]);
//                 // });

//                 swal({
//                     title: data.msg,
//                     text: "You clicked the button!",
//                     icon: "warning",
//                     button: "Aww yiss!",
//                 });
//             }
//             else{
                
//                 swal({
//                     title: data.msg,
//                     text: "You clicked the button!",
//                     icon: "success",
//                     button: "Aww yiss!",
//                 });
            
//             }
//         }
//     });
// });