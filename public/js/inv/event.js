$(function () {
    table_listEvent();
    event_hasPassed();
});
//buatEvent.blade.php
    //do hide and show if event_held had choosen -- onchange select
    function event_willbe_held() {
        var event_held = $("#will_beheld, #edit_will_beheld").val(); 
        console.log(event_held);
        if (event_held == "online") {
            document.querySelector('#event_link').classList.remove('d-none');
            document.querySelector('#event_provinsi').classList.add('d-none');
            document.querySelector('#event_kota').classList.add('d-none');
            document.querySelector('#event_address').classList.add('d-none');
        
        }
        else if (event_held == "offline") {
            document.querySelector('#event_link').classList.add('d-none');
            document.querySelector('#event_provinsi').classList.remove('d-none');
            document.querySelector('#event_kota').classList.remove('d-none');
            document.querySelector('#event_address').classList.remove('d-none');
        }
    }

    //show cities when province selected
    function show_cities() {
        $("#hidden_province_name").val($('select[name="provinsi_event"] option:selected').text());

        let provindeId = $('select[name="provinsi_event"]').val();
        if (provindeId) {
            jQuery.ajax({
                url: '/cities/'+provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="kota_event"]').empty();
                    $('select[name="kota_event"]').append('<option value="" selected>-- pilih kota --</option>');
                    $.each(response, function (key, value) {
                        var id = value["city_id"];
                        $('select[name="kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                    });
                    
                },
            });
        } else {
            $('select[name="kota_event"]').append('<option value="">-- pilih kota --</option>');
        }
    }

    function get_city() {  
        $("#hidden_city_name").val($('select[name="kota_event"] option:selected').text());
    }

    //to show image what user had choosen in preview
    function previewFile() {
        var file = $("#exampleInputFile").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
                console.log(file);
            }
            reader.readAsDataURL(file);
        }
    }

    //show image preview to modal
    $("#pop").on("click", function() {
        $('#imagepreview').attr('src', $('#previewImg').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });

//end of buatEvent.blade.php

//detailEvent.blade.php
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

    function table_listParticipant(id) {
        //var id = $("#coba_id2").text(); 
        var t = $('#table_participant').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: '/inv/listEvent/listParticipant/' + id,
                type: 'GET'
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
                    data: 'name',
                    name: 'name',
                    
                },
                
            ],
            
        });

        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    }
//end of detailEvent.blade.php

//editEvent.blade.php
    function edit_event_willbe_held() {
        var event_held = $("#edit_will_beheld").val(); 
    
        if (event_held == "Online") {
            document.querySelector('#events_link').classList.remove('d-none');
            document.querySelector('#events_provinsi').classList.add('d-none');
            document.querySelector('#events_kota').classList.add('d-none');
            document.querySelector('#events_address').classList.add('d-none');
        
        }
        else if (event_held == "Offline") {
            document.querySelector('#events_link').classList.add('d-none');
            document.querySelector('#events_provinsi').classList.remove('d-none');
            document.querySelector('#events_kota').classList.remove('d-none');
            document.querySelector('#events_address').classList.remove('d-none');
        }
    }

    function previewFile2() {
        var file = $("#exampleInputFile2").get(0).files[0];
        console.log(file);
        if (file) {
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg2").attr("src", reader.result);
                console.log(file);
            }
            reader.readAsDataURL(file);
        }
    }

    //show cities when province selected
    function show_cities2() {
        let provindeId = $('select[name="edit_provinsi_event"]').val();
        console.log("id provinsi :" + provindeId);
        if (provindeId) {
            jQuery.ajax({
                url: '/cities/'+provindeId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="edit_kota_event"]').empty();
                    $('select[name="edit_kota_event"]').append('<option value="" selected>-- pilih kota --</option>');
                    $.each(response, function (key, value) {
                        var id = value["city_id"];
                        $('select[name="edit_kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                    });
                },
            });
        } else {
            $('select[name="edit_kota_event"]').append('<option value="">-- pilih kota --</option>');
        }
    }
//end of editEvent.blade.php

//listEvent.blade.php
    //function table list event -- show all event from the user who is login
    function table_listEvent() {
        $('#table_listEvent').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: '/inv/listEvent',
                type: 'GET'
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'held',
                    name: 'held',
                
                },
                {
                    data: null,
                    name: 'status',
                    render: data => {
                        var status="";
                        if(data.status == "1")
                        {
                            status = "Aktif";
                        }
                        else if (data.status == "2") {
                            status = "Selesai";
                        }else{
                            status = "Tidak Aktif";
                        }
                        return status;
                    }
                },
                {
                    data: null,
                    name: 'event_schedule',
                    render: data => {
                        
                        var hari = moment(data.event_schedule).format('dddd');
                        if (hari == "Sunday") {
                            hari = "Minggu";
                        }
                        else if (hari == "Monday") {
                            hari = "Senin";
                        }
                        else if (hari == "Tuesday") {
                            hari = "Selasa";
                        }
                        else if (hari == "Wednesday") {
                            hari = "Rabu";
                        }
                        else if (hari == "Thursday") {
                            hari = "Kamis";
                        }
                        else if (hari == "Friday") {
                            hari = "Jumat";
                        }
                        else if (hari == "Saturday") {
                            hari = "Sabtu";
                        }
                        var jadwal = moment(data.event_schedule).format('DD/MMM/YYYY');
                        return hari + ', ' + jadwal+'<br><small>'+data.event_time+'</small><br>';
                    }
                },
                {
                    data:null,
                    name:'action',
                    render: data => {
                        var status="";
                        var action="";
                        
                        action += '<a href="javascript:void(0)" data-toggle="modal" data-target="#editEventModal"  data-id="'+data.id+'" data-original-title="Edit" class="edit btn btn-warning btn-sm editEvent">Detail</a>';

                        //aktif
                        if (data.status == "1") {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonaktifEvent">Nonaktifkan</a>';
                        }

                        //tidak aktif
                        else if(data.status == "4")
                        {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm aktifEvent">Aktifkan</a>';

                        }
                        
                        return data.action + action;
                    }
                },
            ],
            
        });
    }

    function open_city(idprovince, idcity, status) {   
        console.log("id city :" + idcity);
        if (idprovince) {
            jQuery.ajax({
                url: '/cities/'+idprovince,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $('select[name="edit_kota_event"]').empty();
                    
                    $('select[name="edit_kota_event"]').append('<option value="" selected>-- pilih kota --</option>');
                    $.each(response, function (key, value) {
                        var id = value["city_id"];
    
                        if (status == "detailEvent" && idcity == id) {
                            var provinceName = value["province"];
                            var cityName = value["city_name"];
                            $('#loc_detailEvent').text(provinceName + ", " + cityName);
                            console.log(provinceName + " " + cityName);
                        }
                        else if (status == "editProduct") {
                            $('select[name="edit_kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
                        }
                    });
                    $('select[name="edit_kota_event"]').find('option[value="'+idcity+'"]').attr("selected",true);
                },
            });
    } else {
        $('select[name="edit_kota_event"]').append('<option value="">-- pilih kota --</option>');
        }
    }

    $('body').on('click', '.editEvent', function () {
        var product_id = $(this).data('id');
        table_listParticipant(product_id);

        $.ajax({
            type: "get",
            url: '/inv/listEvent/editEvent' + '/' + product_id,
            contentType: "application/json",
            success: function (data) {
                $('#coba_id').val(data.id);
                $('#edit_nama_event').val(data.name);
                $('#edit_desc_event').val(data.desc);
                $('#edit_will_beheld').val(data.held);
    
                edit_event_willbe_held();    
                var held = $('#edit_will_beheld').val(data.held);
                $('#edit_link_event').val(data.link);
                $('#edit_provinsi_event').val(data.id_province);
                
                var status = "editProduct";
                open_city(data.id_province, data.id_city, status);
                
                $('#edit_address_event').val(data.address);
                $('#edit_jadwal_event').val(data.event_schedule);
                $('#edit_time_event').val(data.event_time);
    
                var gmbr = "/uploads/event/"+data.image;
                console.log(gmbr);
                $("#previewImg2").attr("src", gmbr);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        /*$.get(url_editProduct + product_id, function (data) {
              $('#coba_id').val(data.id);
              $('#edit_nama_event').val(data.name);
              $('#edit_desc_event').val(data.desc);
              $('#edit_will_beheld').val(data.held);
  
              edit_event_willbe_held();    
              var held = $('#edit_will_beheld').val(data.held);
              $('#edit_link_event').val(data.link);
              $('#edit_provinsi_event').val(data.id_province);
              
              var status = "editProduct";
              open_city(data.id_province, data.id_city, status);
              
              $('#edit_address_event').val(data.address);
              $('#edit_jadwal_event').val(data.event_schedule);
              $('#edit_time_event').val(data.event_time);
  
              var gmbr = "/uploads/event/"+data.image;
              console.log(gmbr);
              $("#previewImg2").attr("src", gmbr);
             
        })*/
    });

    $('body').on('click', '.nonaktifEvent', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah Anda yakin ingin menonaktifkan event ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                        type: "get",
                        url: '/inv/listEvent/nonaktifEvent/' + id,
                        success: function (data) {
                            if (data == 0) {
                                swal("Gagal menonaktifkan event, karena ada participant", {
                                    icon: "warning",
                                });
                            }
                            else{
                                swal("Berhasil menonaktifkan event", {
                                    icon: "success",
                                });
                            }
                            table_listEvent();
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

    $('body').on('click', '.aktifEvent', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah Anda yakin ingin menonaktifkan event ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                    $.ajax({
                        type: "get",
                        url: '/inv/listEvent/aktifEvent/' + id,
                        success: function (data) {
                            if (data == 1) {
                                swal("Berhasil meng-aktifkan event", {
                                    icon: "success",
                                });
                            }
                            table_listEvent();
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

    function cetak_riwayatEvent() { 
        var dateawal = $("#date_awal").val();
        var dateakhir = $("#date_akhir").val();
        var piljenisEvent = $("#select_jenisEvent").val();
        var pilstatusEvent = $("#select_statusEvent").val();
        window.open("/inv/report/cetak_riwayatEvent/"+dateawal+"/"+dateakhir+"/"+piljenisEvent+"/"+pilstatusEvent);
     }
    
     function cetak_participantEvent() {  
         var id = $("#coba_id").val();
        
        window.open("/inv/report/cetak_participantEvent/"+id);
     }

     function event_hasPassed() {  
        $.ajax({
            type: "get",
            url: "/eventPassed",
            success: function (data) {
                console.log('ok');
               
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    
    
    }
//end of listEvent.blade.php