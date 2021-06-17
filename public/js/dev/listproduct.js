
//Dibawah ini adalah function pada dev/product/listProduct.blade.php
$(function () {
    
    table_listProduct();

    //daftarProductBaru.blade.php
    show_listProject_select();
    show_jenis_produk();

});
    

//tabel Project Terdaftar Aktif
function table_listProduct() {
    var tabel0 = "#table_listProductConfirmYet";
    var tabel1 = "#table_listProduct";
    var tabel2 = "#table_listProductInvestor";
    var tabel3 = "#table_listProductNonAktif";
   
    
    $('#table_listProductConfirmYet').DataTable({
        destroy:true,
        fixedHeader: true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/dev/listProduct",
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
            url: "/dev/listProduct",
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
            url: "/dev/listProduct",
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
            url: "/dev/listProduct",
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
    var cekTabel = $(this).attr("id");
    if (cekTabel == "table_listProductNonAktif" || cekTabel == "table_listProductInvestor" ) {
        $("#submit_updDetail").addClass("d-none");
        $('#nama_product, #edit_jenis_produk, #edit_detail_kategori, #url_product, #rilis_product, #desc,#team, #reason, #benefit,#solution ').attr('disabled', 'disabled').css("background-color", "white");
    }
    else{
        $('#nama_product, #edit_jenis_produk, #edit_detail_kategori, #url_product, #rilis_product, #desc,#team, #reason, #benefit,#solution ').removeAttr('disabled', 'disabled');
        $("#submit_updDetail").removeClass("d-none");
    }
    
    console.log(cekTabel);
    var product_id = $(this).data('id');
    table_pemasukkan_pengeluaran(product_id);
    
    $('#id_product').val(product_id); 
    $.ajax({
        type: "GET",
        url: "/dev/listProduct/detailProject/"+ product_id,
        contentType: 'application/json',
        success:function(data) 
        {
            $("img#previewImg").attr("src", "/uploads/event/"+data.image);
            $('#nama_product').val(data.name_product);  
            var id =data.id_detailcategory; 
            
            $.ajax({
                type: "GET",
                url: "/dev/listProduct/get_categoryID/" + id,
                contentType: 'application/json',
                success:function(data) 
                {
                    $('#edit_jenis_produk').val(data.category_id); 
                    $.ajax({
                        type: "GET",
                        url: "/dev/listProduct/detailKategori/" + data.category_id,
                        contentType: 'application/json',
                        success:function(data) 
                        {
                            $('select[name="edit_detail_kategori"]').empty();
                                $('select[name="edit_detail_kategori"]').append('<option value="" selected>-- pilih kota --</option>');
                                $.each(data, function (key, value) {
                                    var idnya = value["id"];
                                    $('select[name="edit_detail_kategori"]').append('<option value="'+ idnya + '">' + value["name"] + '</option>');
                                });
                                $('select[name="edit_detail_kategori"]').find('option[value="'+id+'"]').attr("selected",true);
                                
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
            
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
        
            });
            $('#url_product').val(data.url); 
            $('#rilis_product').val(data.rilis); 
            $('#desc').val(data.desc); 
            $('#team').val(data.team);
            $('#reason').val(data.reason); 
            $('#benefit').val(data.benefit);
            $('#solution').val(data.solution);
        },
        error: function (data) {
            console.log('Error:', data);
        }

   });
   

});

$('body').on('click', '.deleteProject', function () {
    var id = $(this).data("id");
    
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
                url: "/dev/listProduct/deleteProject/" + id,
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
                url: "/dev/listProduct/activeProject/" + id,
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
                url: "/dev/listProduct/nonactiveProject/" + id,
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
    $.ajax({
        type: "get",
        url: url_show_listProject_select,
        contentType: 'application/json',
        success: function (response) {
            
            $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"],  select[name="pilih_project_cetak"]').empty();
            $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"],  select[name="pilih_project_cetak"]').append('<option value="" disabled>-- pilih Project Anda --</option>');
            $.each(response, function (key, value) {
                var id = value["id"];
                $('select[name="pilih_project_masuk"], select[name="pilih_project_keluar"], select[name="pilih_project_cetak"]').append('<option value="'+ id + '"> #' + value['id'] + ' - '+  value["name_product"] + '</option>');
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
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
          
            //Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(total)
            );
            
                                 
        }
        
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
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
          
            //Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 3 ).footer() ).html(
                $.fn.dataTable.render.number('.','.','2','Rp').display(total)
            );
            
                                 
        }
       
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
                data: 'name',
                name: 'name',
              
            },
            {
                data: null,
                name: 'invest_expire',
                render: data => {
                    return moment(data.invest_expire).format('DD/MMM/YYYY');
                }
            },
            {
                data: 'jumlah_final',
                name: 'jumlah_final',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp')
              
            },
            {
                data: null,
                name: 'status_invest',
                render: data => {
                    if (data.status_invest == "5") {
                        return "Berakhir";
                    }else if (data.status_invest == "1") {
                        return "Aktif";
                    }
                    else if (data.status_invest == "4") {
                        return "Di cancle";
                    }else{
                        return "Menunggu Konfirmasi";
                    }
                    
                }
            },
        ],
        
    });

    $('#table_listReviews').DataTable({
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
            url: "/dev/listProduct/detailProjectReview/" + id,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: null,
                name: 'id',
                render: data => {
                    return "#" + data.id;
                }
              
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: data => {
                    return moment(data.created_at).format('DD/MMM/YYYY');
                }
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: null,
                name: 'rating',
                render: data => {
                    var coba="<label> <div class='stars' data-rating='0'>";
                    for (let index = 0; index < data.rating; index++) {
                        coba = coba + "<span class='star rated' data-rating='" + index + "'>&nbsp;</span>";
                    }
                    coba = coba + "</div>" + data.isi_review + "</label>" ;
                    return coba;
                }
            },
            
        ],
        
    });
}

//detailProduct -- deskripsi
function show_jenis_produk() { 
   
    $.ajax({
        type: "GET",
        url: "/dev/listProduct/jenisProject",
        success:function(data) 
        {
            $('select[name="edit_jenis_produk"]').empty();
                $('select[name="edit_jenis_produk"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(data, function (key, value) {
                    var id = value["id"];
                    $('select[name="edit_jenis_produk"]').append('<option value="'+ id + '">' + value["name_category"] + '</option>');
                });
             
        },
        error: function (data) {
            console.log('Error:', data);
        }

   });
}


function show_detail_kategori(id) { 
    var id = $("#edit_jenis_produk").val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/dev/listProduct/detailKategori/" + id,
        contentType: 'application/json',
        success:function(data) 
        {
            $('select[name="edit_detail_kategori"]').empty();
                $('select[name="edit_detail_kategori"]').append('<option value="" selected>-- pilih kota --</option>');
                $.each(data, function (key, value) {
                    var idnya = value["id"];
                    $('select[name="edit_detail_kategori"]').append('<option value="'+ idnya + '">' + value["name"] + '</option>');
                });
                
        },
        error: function (data) {
            console.log('Error:', data);
        }

   });

    
}

//detailproduct -- deskripsi - edit
$("#updDetailProject").on("submit",function (e) {
   
    e.preventDefault();
   
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function() {
            $(document).find('span.error-text').text('');
        },
        success:function(data) {
            if (data.status == 0) {
                $.each(data.error, function (prefix, val) {
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }
            else{
                table_listProduct();
                swal({
                    title: "Berhasil ubah detail",
                    icon: "success",
                    button: "Aww yiss!",
                });
               
            }
        }
    });
});