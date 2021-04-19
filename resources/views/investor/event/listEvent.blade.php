
@include('investor.event.editEvent')
@include('investor.event.detailEvent')
<div class="row py-4">
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Diadakan Secara</th>
                    <th>Jadwal Acara</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
  table_listEvent();
});
var table = $('#table_listEvent').DataTable;
var coba="";
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
            url: "{{ route('inv.listEvent') }}",
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
                data:'action',
                name:'action',
            },
        ],
        
    });
}



 $('body').on('click', '.detailEvent', function () {
     var product_id = $(this).data('id');
     table_listParticipant(product_id);
     $.get("{{ route('inv.listEvent') }}" +'/editEvent' + '/' + product_id, function (data) {
        $('#coba_id2').val(data.id);    
        $('#title_detailevent').text(" " + data.name);
        $('#desc_detailevent').text(data.desc);
        $('#held_detailEvent').text(data.held);
        held_detailEvent();
        $('#link_detailEvent').html("<i class='fas fa-map-marker-alt none'></i>").text(data.link);
        $('#add_detailEvent').text(data.address);
        
        var status = "detailEvent";
        open_city(data.id_province, data.id_city, status);
        
        var jadwal = moment(data.event_schedule).format('DD/MMM/YYYY');
        var jam = moment(data.event_time).format('h:mm');
        
        $('#date_detailEvent').text(jadwal);
        $('#time_detailEvent').text(jam);
    });
 });


$('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('inv.listEvent') }}" +'/editEvent' + '/' + product_id, function (data) {
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
           
      })
});



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


$('body').on('click', '.deleteEvent', function () {
     
    var id = $(this).data("id");
    var txt;
    swal({
        title: "Are You sure want to delete?",
        text: "Once deleted, you will not be able to recover this event!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "{{ route('inv.listEvent') }}"+'/deleteEvent' + '/' + id,
                    success: function (data) {
                        table_listEvent();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });

});
</script>