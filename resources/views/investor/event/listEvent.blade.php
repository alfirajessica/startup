
@include('investor.event.editEvent')
<div class="row py-4">
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
            <thead>
                <tr>
                    <th>Nama Event</th>
                    <th>Diadakan Secara</th>
                    <th>Jadwal Acara</th>
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
                data: 'name',
                name: 'name'
            },
            {
                data: null,
                name: 'held',
                render: data => {
                    if (data.held == "Offline") {
                        return data.held+'<br><small><p>'+data.province+'</p></small><br>';
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
                data:'action',
                name:'action',
            },
        ],
    });
}


$('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('inv.listEvent') }}" +'/editEvent' + '/' + product_id, function (data) {
            $('#coba_id').val(data.id);
            $('#nama_event').val(data.name);
            $('#desc_event').val(data.desc);
            $('#edit_will_beheld').val(data.held);

            edit_event_willbe_held();    
            var held = $('#edit_will_beheld').val(data.held);
            $('#link_event').val(data.link);
            $('#edit_provinsi_event').val(data.province);
            
            open_city(data.province, data.city);
            
            $('#address_event').val(data.address);
            $('#jadwal_event').val(data.event_schedule);
            $('#time_event').val(data.event_time);

            var gmbr = "/uploads/event/"+data.image;
            console.log(gmbr);
            $("#previewImg2").attr("src", gmbr);
           
      })
});

function open_city(idprovince, idcity) { 
  
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
                    $('select[name="edit_kota_event"]').append('<option value="'+ id + '">' + value["city_name"] + '</option>');
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