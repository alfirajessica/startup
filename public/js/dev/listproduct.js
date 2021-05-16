
//Dibawah ini adalah function pada dev/product/listProduct.blade.php
$(function () {
    
    table_listProduct();

    //daftarProductBaru.blade.php
    show_listProject_select();
});
    

//tabel Project Terdaftar Aktif
function table_listProduct() {
    var tabel0 = "#table_listProductConfirmYet";
    var tabel1 = "#table_listProduct";
    var tabel2 = "#table_listProductInvestor";
    var tabel3 = "#table_listProductNonAktif";

    $('#table_listProductConfirmYet').DataTable({
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
                "tabel0":tabel0,
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
                data: 'created_at',
                name: 'created_at',
              
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
    table_pemasukkan_pengeluaran(product_id);
    console.log(product_id);
    $.get(url_table_listProduct_detailProject + product_id, function (data) {
        console.log("/uploads/event/"+data.image);
        $("img#previewImg").attr("src", "/uploads/event/"+data.image);
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

   //get detail investornya
//    $.get(url_table_listProduct_detailProject + product_id, function (data) {
//     console.log("/uploads/event/"+data.image);
    
//     });

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



//daftarProductBlade.php
function show_listProject_select() {
        
    jQuery.ajax({
        url: url_show_listProject_select,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log('masuk');
            $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"]').empty();
            $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"]').append('<option value="" disabled>-- pilih Project Anda --</option>');
            $.each(response, function (key, value) {
                var id = value["id"];
                $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"]').append('<option value="'+ id + '"> #' + value['id'] + ' - '+  value["name_product"] + '</option>');
            });
            
        },
    });
}

//detailProduct Transaksi Pemasukkan dan Pengeluaran
var getTotal, getUangmuka, temptotal='';

function table_pemasukkan_pengeluaran(id) {
    var groupColumn = 1;
    var get="";

    var tabel0 = "#table_pemasukkan";
    var tabel1 = "#table_pengeluaran";

    $('#table_pemasukkan').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        language: {
            "emptyTable": "Silakan Atur Pemasukkan Anda pada Tab Pemasukkan"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/dev/listProduct/detailProjectKas/" + id,
            type: 'GET',
            data:{
                "getTabel":tabel0,
                },
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'tipe',
                render: data => {
                    var tipe="";
                    if (data.tipe == "1") {
                        tipe = "+";
                    }else{
                        tipe = "-"
                    }
                    return tipe;
                }
            },
            {
                data: null,
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp')
              
            },
        ],
        
    });

    $('#table_pengeluaran').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        language: {
            "emptyTable": "Silakan Atur Pengeluaran Anda pada Tab Pengeluaran"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/dev/listProduct/detailProjectKas/" + id,
            type: 'GET',
            data:{
                "getTabel":tabel1,
            },
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'tipe',
                render: data => {
                    var tipe="";
                    if (data.tipe == "1") {
                        tipe = "+";
                    }else{
                        tipe = "-"
                    }
                    return tipe;
                }
            },
            {
                data: null,
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'keterangan',
                name: 'keterangan',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp')
              
            },
           
        ],
       
    });

    $('#table_listInv').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        language: {
            "emptyTable": "Belum ada investor pada proyek ini"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/dev/listProduct/detailProjectKas/" + id,
            type: 'GET',
            data:{
                "getTabel":"#table_listInv",
                },
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'invest_id',
                name: 'invest_id',
                
            },
            {
                data: null,
                name: 'invest_expire',
                render: data => {
                    return moment(data.invest_expire).format('DD/MMM/YYYY')
                }
            },
            {
                data: 'name',
                name: 'name',
              
            },
            {
                data: 'jumlah_final',
                name: 'jumlah_final',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp')
              
            },
        ],
        
    });
}
