$(function () {
    table_list_cancel_history();
    
});

function table_list_cancel_history() {  
    $('#table_listEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listEvent,
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
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
                name:'id_header_events',
                render: data => {
                    
                    var id = data.id_header_events;
                    return '<a href="javascript:void(0)" data-original-title="Detail" class="edit btn btn-danger btn-sm" onclick="cancle_join('+id+')" >Batal Ikuti</a>';
                }
            },
        ],
        
    });

    $('#table_listcancleEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listcancleEvent,
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
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
        ],
        
    });

    $('#table_listHistoryEvent').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listHistoryEvent,
            type: 'GET'
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                     if (data.held == "Offline") {
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'</small><br>';    
                     }
                     else if (data.held == "Online") {
                         return data.held+'<br><small><a href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
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
        ],
        
    });
}


function cancle_join(id) { 
    console.log(id);
    var txt;
    swal({
        title: "Apakah Anda yakin untuk batal ikut event ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/dev/event/cancleEvent/" + id,
                    success: function (data) {
                        table_list_cancel_history();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            
            swal("Anda telah batal ikuti event ini", {
            icon: "success",
        });
        } else {
            //swal("Your imaginary file is safe!");
        }
    });

 }

