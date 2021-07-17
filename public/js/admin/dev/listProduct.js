$(function () {
    table_allListProductDev();
});
function table_allListProductDev() {
    $('#table_allListProductDev').DataTable({
        destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/dev/allListProduct",
                type: 'GET'
            },
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: data => {
                        return "#"+data.id;
                    }
                },
                {
                    data: null,
                    name: 'user_id',
                    render: data => {
                        return "#"+data.user_id+" - "+data.name;
                    }
                },
                {
                    data: 'name_product',
                    name: 'name_product',
                },
                {
                    data: null,
                    name: 'status',
                    render: data => {
                        var statusnya="";
                        if (data.status == "0") {
                            statusnya = "Menunggu Konfirmasi";
                        }
                        else if (data.status == "3") {
                            statusnya = "Dinonaktifkan Dev";
                        }
                        else{
                            statusnya = "Aktif";
                        }
                        return statusnya;
                    }
                  
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
}

$('body').on('click', '.detailProject', function () {
    var id = $(this).data('id');
    table_detailProjectTerdata(id);
    
   });

function table_detailProjectTerdata(id) { 
    $('#table_detailProjectTerdata').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/admin/dev/allListProduct/detail/" + id,
            type: 'GET'
        },
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
        order: [
            [0, 'asc']
        ]
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
    }else{
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