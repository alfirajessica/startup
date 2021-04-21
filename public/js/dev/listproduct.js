
//Dibawah ini adalah function pada listProduct.blade.php
$(function () {
    table_listProduct();
});

//tabel Project Terdaftar Aktif
function table_listProduct() {
    var tabel1 = "#table_listProduct";
    var tabel2 = "#table_listProductNonAktif";
    var tabel3 = "#table_listProductInvestor";
    $('#table_listProduct').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listProduct,
            type: 'GET',
            data:{
                "tabel1":tabel1,
                },
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

    $('#table_listProductInvestor').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listProduct,
            type: 'GET',
            data:{
                "tabel2":tabel2,
                },
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

    $('#table_listProductNonAktif').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listProduct,
            type: 'GET',
            data:{
                "tabel3":tabel3,
                },
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
$('body').on('click', '.detailProject', function () {
    var product_id = $(this).data('id');
    $.get(url_table_listProduct_detailProject + product_id, function (data) {
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
                url: url_table_listProduct_deleteProject + id,
                success: function (data) {
                    table_listProduct();
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

$('body').on('click', '.aktifProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Are You sure want to activate?",
        text: "Once deleted, you will not be able to recover this project!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: url_table_listProduct_activeProject + id,
                success: function (data) {
                    table_listProduct();
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

$('body').on('click', '.nonAktifProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Are You sure want to nonactivate?",
        text: "Once deleted, you will not be able to recover this project!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: url_table_listProduct_nonactiveProject + id,
                success: function (data) {
                    table_listProduct();
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

