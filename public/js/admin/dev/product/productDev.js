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
                data: null,
                name: 'id',
                className: 'dt-body-center',
                render: data => {
                    return "#"+data.id;
                }
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
                data: null,
                name: 'action',
                render: data => {
                    var action="";
                    if (data.status == 0) {
                       action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Confirm" class="btn btn-success btn-sm confirmProject" data-tr="tr_{{$product->id}}">Konfirmasi</a>';

                       action += '<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_alasanTdkDikonfirmasi"  data-id="'+data.id+'" data-original-title="notConfirm" class="btn btn-danger btn-sm notConfirmProject" data-tr="tr_{{$product->id}}">Tidak Dikonfirmasi</a>';

                    }else{
                        action += '<a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-outline-secondary btn-sm"> Menunggu perbaikan Dev.</a>'; 
                    }
                    
                    return data.action + action;
                }
            },
            
        ],
        
    });

 }

$('body').on('click', '.detailProject', function () {
    var product_id = $(this).data('id');
    var cekTabel = $(this).attr("id");
    console.log(cekTabel);
    if(cekTabel == "table_listProductConfirmYet"){
        $("#alert_tdkdikonfirmasi").removeClass("d-none");
        $.ajax({
            type: "get",
            url: "/admin/dev/listProductDev/get_allReasonTdkDikonfirmasi/" + product_id,
            success: function (data) {
                $("#cetak_reasonTdkdikonfirmasi").text(data[0]['reason']);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });  
    }
    else{
        $("#alert_tdkdikonfirmasi").addClass("d-none");
    }

    $.get("/admin/dev/listProductDev/detailProject/" + product_id, function (data) {
       $("img#previewImg").attr("src", "/uploads/event/"+data.image);
       $('#nama_product').val(data.name_product);    
       
       $('#url_product').val(data.url); 
       $('#rilis_product').val(data.rilis); 
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
                $("#kategori_product").val(data[0]['name_category']+"/"+data[0]['name']);
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            type: "get",
            url: "/admin/dev/listProductDev/getDetailSubStartupTag/" + data.id_substartuptag,
            success: function (data) {
                $("#startup_tagProduct").val(data[0]['name_startup_tag']+"/"+data[0]['name_subtag']);
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
       
   });
   table_pemasukkan_pengeluaran(product_id);
});

$('body').on('click', '.confirmProject', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        text: "Yakin Ingin mengkonfirmasi proyek ini?",
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
    $("#productID").val(id);
});


$("#modal_alasanTdkDikonfirmasi_form").on("submit",function (e) { 
    e.preventDefault();
    console.log(e);
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
                table_listProject_ConfirmYet();
                swal("Berhasil Tidak Konfirmasi", {
                    icon: "success",
                });
                $("#modal_alasanTdkDikonfirmasi").modal('hide');
                //jika sukses, call swal
                
            }
        }
    });
});

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
            url: "/admin/dev/listProductDev/detailProjectKas/" + id,
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
                className: 'dt-body-center',
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
                render: $.fn.dataTable.render.number( '.', ',', 2, '')
              
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
                $.fn.dataTable.render.number('.',',','2','').display(total)
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
            url: "/admin/dev/listProductDev/detailProjectKas/" + id,
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
                className: 'dt-body-center',
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
                render: $.fn.dataTable.render.number( '.', ',', 2, '')
              
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
                $.fn.dataTable.render.number('.',',','2','').display(total)
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
            "emptyTable": "Belum Ada Investor pada Startup/Produk Ini"
        },
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/admin/dev/listProductDev/detailProjectKas/" + id,
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
}