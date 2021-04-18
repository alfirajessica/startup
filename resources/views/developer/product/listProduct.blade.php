<div class="row py-4">
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listProduct">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Proyek</th>
                    <th>Kategori</th>
                    <th>Url</th>
                    
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>

@include('developer.product.detailProduct')



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
  table_listProduct();
});

function table_listProduct() {
    $('#table_listProduct').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "{{ route('dev.listProduct') }}",
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
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'name',
                name: 'name',
              
            },
            {
                data: 'action',
                name: 'action',
              
            },
            
        ],
        
    });
}

$('body').on('click', '.deleteProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Are You sure want to delete?",
        text: "Once deleted, you will not be able to recover this project!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "{{ route('dev.listProduct') }}"+'/deleteProject' + '/' + id,
                success: function (data) {
                    table_listProduct();
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

 $('body').on('click', '.detailProject', function () {
     var product_id = $(this).data('id');
     $.get("{{ route('dev.listProduct') }}" +'/detailProject' + '/' + product_id, function (data) {
        table_detailProduct(product_id);
        
        $('#nama_product').text(data.name_product);    
        $('#tipe_product').text(data.id_detailcategory); 
        $('#url_product').text(data.url); 
        $('#rilis_product').text(moment(data.rilis).format('DD/MMM/YYYY')); 
        $('#desc').text(data.desc); 
        $('#team').text(data.team);
        $('#reason').text(data.reason); 
        $('#benefit').text(data.benefit);
        $('#solution').text(data.solution);
    });
 });
</script>