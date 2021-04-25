$(function () {
    table_listProject_ConfirmYet();
});


function table_listProject_ConfirmYet() { 
    $('#table_listProductConfirmYet').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listProductConfirmYet,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'email',
                name: 'email',
              
            },
            {
                data: 'name_product',
                name: 'name_product',
              
            },
            {
                data: 'action',
                name: 'action',
            },
            
        ],
        
    });

 }

$('body').on('click', '.detailProject', function () {
    var product_id = $(this).data('id');
    console.log('masuk dengan');
    $.get(url_table_listProductConfirmYet_detailProject + product_id, function (data) {
       //table_detailProduct(product_id);
       //$('#nama_product').text('coba');
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

$('body').on('click', '.confirmProject', function () {
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
                url: url_table_listProductConfirmYet_confirmProject + id,
                success: function (data) {
                    table_listProject_ConfirmYet();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            //jika sukses, call swal
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
});

$('body').on('click', '.notConfirmProject', function () {
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
                url: url_table_listProductConfirmYet_notConfirmProject + id,
                success: function (data) {
                    table_listProject_ConfirmYet();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            //jika sukses, call swal
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
});
