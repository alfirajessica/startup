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
            url: "/admin/dev/listProductDev",
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
    $.get("/admin/dev/listProductDev/detailProject/" + product_id, function (data) {
       //table_detailProduct(product_id); 
       $("img#previewImg").attr("src", "/uploads/event/"+data.image);
       $('#nama_product').text(data.name_product);    
       
       $('#url_product').text(data.url); 
       $('#rilis_product').text(moment(data.rilis).format('DD/MMM/YYYY')); 
       $('#desc').text(data.desc); 
       $('#team').text(data.team);
       $('#reason').text(data.reason); 
       $('#benefit').text(data.benefit);
       $('#solution').text(data.solution);

       var idsubkategori = data.id_detailcategory;
       $.ajax({
            type: "get",
            url: "/admin/dev/listProductDev/getDetailKategori/" + idsubkategori,
            success: function (data) {
                $("#kategori_product").text(data[0]['name_category']+"/"+data[0]['name']);
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
       
   });
});

$('body').on('click', '.confirmProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Yakin Ingin mengkonfirmasi proyek ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "/admin/dev/listProductDev/confirmProject/" + id,
                success: function (data) {
                    table_listProject_ConfirmYet();
                    //jika sukses, call swal
                    swal("Berhasil Konfirmasi", {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            
        } else {
           // swal("Kamu meng-cancle konfirmasi proyek ini");
        }
    });
});

$('body').on('click', '.notConfirmProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Yakin ingin Tidak mengkonfirmasi?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: "/admin/dev/listProductDev/notConfirmProject/" + id,
                success: function (data) {
                    table_listProject_ConfirmYet();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            //jika sukses, call swal
            swal("Berhasil Tidak Konfirmasi", {
            icon: "success",
        });
        } else {
           // swal("Kamu meng-cancle untuk tidak konfirmasi proyek ini");
        }
    });
});
