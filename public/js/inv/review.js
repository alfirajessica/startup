$(function () {
    listReviews();
   
});

//investor - detailStartup - ulasan.blade.php

$("#beriReview").on("submit",function (e) {
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
                refresh_dataUlasan();
                reset_form();
                swal("Poof! Anda berhasil memberi ulasan!", {
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

function reset_form() { 
    $("#isi_review").val('');
    
    $(".stars").removeAttr('rated');
   document.querySelector('.stars').getAttribute('data-rating').value = '0';
}
//end of investor - detailStartup - ulasan.blade.php

//investor - listReview.blade.php --> history review 
function listReviews() {
    $('#table_listReviews').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listReviews,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'id',
                render: data => {
                    return "#" + data.id;
                }
              
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY');
                }
            },
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: null,
                name: 'rating',
                render: data => {
                    var coba="<label> <div class='stars' data-rating='0'>";
                    for (let index = 0; index < data.rating; index++) {
                        coba = coba + "<span class='star rated' data-rating='" + index + "'>&nbsp;</span>";
                    }
                    coba = coba + "</div>" + data.isi_review + "</label>" ;
                    return coba;
                }
            },
            
           
        ],
        
    });
}
//end of investor - listReview.blade.php --> history review