moment.locale('id');
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
                         return data.held+'<br><small>'+ data.province_name + '/' +data.city_name+'<br>'+data.address+"</small>";    
                     }

                     else if (data.held == "Online") {
                         return data.held+'<br><small style="white-space: initial;word-wrap: break-word;"><a style="word-break: break-word;" href="'+ data.link +'">'+data.link+'</a></small><br>';    
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    
                    moment.locale('id');
                    var jadwal = moment(data.event_schedule).format('dddd, DD-MMM-YYYY');
                    return 'Pada : ' + jadwal+'<br> Jam : '+ moment(data.event_time).format('hh:mm') +'<br>';
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
                        return data.held+'<br><small style="white-space: initial;word-wrap: break-word;"><a style="word-break: break-word;" href="'+ data.link +'">'+data.link+'</a></small><br>';        
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    
                    moment.locale('id');
                    var jadwal = moment(data.event_schedule).format('dddd, DD-MMM-YYYY');
                    return 'Pada : ' + jadwal+'<br> Jam : '+ moment(data.event_time).format('hh:mm') +'<br>';
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
                        return data.held+'<br><small style="white-space: initial;word-wrap: break-word;"><a style="word-break: break-word;" href="'+ data.link +'">'+data.link+'</a></small><br>';     
                     }
                    
                 }
            },
            {
                data: null,
                name: 'event_schedule',
                render: data => {
                    moment.locale('id');
                    var jadwal = moment(data.event_schedule).format('dddd, DD-MMM-YYYY');
                    return 'Pada : ' + jadwal+'<br> Jam : '+ moment(data.event_time).format('hh:mm') +'<br>';
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

