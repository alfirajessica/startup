$(function () {
   
});
$("#beriReview").on("submit",function (e) {
   
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
            if (data.status == 0) {
                $.each(data.error, function (prefix, val) {
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
            else{
               
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "success",
                    button: "Aww yiss!",
                });
                refresh_dataUlasan();
                
            }
        }
    });
});

function refresh_dataUlasan() 
{ 
    var id = $("#project_id_ulas").val();
    $.ajax({
        type: "GET",
        url: '/inv/review/refreshUlasan/' + id,
        success:function(data) {
          console.log(data);
          if (data == null) {
            $('#data_ulasan').html("kosong");
          } else {
            $('#data_ulasan').html(data);
          }
          
        }
      });
}