$(function () {
    //show_detailprofil();

    var idprovinsi = $('#edit_provinsi_user').val();
    var idcity = $('#city_id').val();
    $('#hidden_province_name').val( $('#edit_provinsi_user option:selected').text());
    
    open_city(idprovinsi, idcity);
    
});

//akun -- profile
    //munculkan provinsi dan kotanya sesuai data di db
    function open_city(idprovince, idcity) {   
        console.log(idprovince, idcity);

        if (idprovince) {
            jQuery.ajax({
                url: '/cities/'+idprovince,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="edit_kota_user"]').empty();
            
                    $('select[name="edit_kota_user"]').append('<option value="" disabled>-- pilih kota --</option>');
                    $.each(response, function (key, value) {
                        var id = value["city_id"];

                        $('select[name="edit_kota_user"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                    });
                    $('select[name="edit_kota_user"]').find('option[value="'+idcity+'"]').attr("selected",true);
                    $('#hidden_city_name').val( $('#edit_kota_user option:selected').text());
                },
            });
        } else {
            $('select[name="edit_kota_user"]').append('<option value="">-- pilih kota --</option>');
        }
    }

    function show_cities2() {
    
        $('#hidden_province_name').val( $('#edit_provinsi_user option:selected').text());
        
        let provindeId = $('select[name="edit_provinsi_user"]').val();
        console.log("id provinsi :" + provindeId);
        if (provindeId) {
            jQuery.ajax({
                url: '/cities/'+provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="edit_kota_user"]').empty();
                    $('select[name="edit_kota_user"]').append('<option value="" selected>-- pilih kota --</option>');
                    $.each(response, function (key, value) {
                        var id = value["city_id"];
                        $('select[name="edit_kota_user"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                    });
                },
            });
        } else {
            $('select[name="edit_kota_user"]').append('<option value="">-- pilih kota --</option>');
        }
    }
  
    function get_city() {  
      $("#hidden_city_name").val($('select[name="edit_kota_user"] option:selected').text());
    }

    

    $("#updateAkun").on("submit",function (e) {
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
                   //update yang di page akun depan
                   $('[name="location_user"]').text($('#hidden_province_name').val()+", " + $('#hidden_city_name').val());
                   $('[name="name_user"]').text($('#nama_akunUser').val());
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                   
                }
            }
        });
    });
//end of akun -- profile


//akun -- desc
$("#ubahTentang").on("submit",function (e) {
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
               //update yang di page akun depan
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "success",
                    button: "Aww yiss!",
                });
               
            }
        }
    });
});
//end of akun -- desc