//Dibawah ini adalah function pada 
//dev/product/daftarProduct.blade.php
//dev/product/pemasukkanProduct.blade.php
//dev/product/pengeluaranProduct.blade.php
//dev/product/ubahPemasukkan.blade.php --> modal

$(function () {

    if ($('#status_kas').val() == "Pemasukkan") {
        table_listPemasukkan();
    }
    else
    {
        table_listPengeluaran();
    }
    
});

//pemasukkanProduct.blade.php
    $("#pemasukkanProduct").on("submit",function (e) {
        e.preventDefault();
        console.log($(['name="action"']).attr('id'));
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
                console.log(data)
                if (data == 1) {
                    
                    table_listPemasukkan();
                    var terpilih_before = $("#nama_project_dipilih_masuk").text();
                    $("#pilih_project_masuk").find(":selected").text(terpilih_before);
                    $('#tipe_pemasukkan').val(0);
                    $('#jumlah').val('');
                    swal({
                        title: "Berhasil",
                        text: "You clicked the button!",
                        icon: "success",
                    });
                    
                }
                else if(data == -1){
                    var terpilih_before = $("#nama_project_dipilih_masuk").text();
                    $("#pilih_project_masuk").find(":selected").text(terpilih_before);
                    $('#tipe_pemasukkan').val(0);
                    $('#jumlah').val('');
                    swal({
                        title: "Sudah ada",
                        text: "You clicked the button!",
                        icon: "warning",
                    });
                    
                }
                else if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                
            }
        });
    });

    function pilih_proyek() {
        $("#card_masuk").removeClass('d-none');

        var id = $("#pilih_project_masuk").find(":selected").val();
        $("#nama_project_dipilih_masuk").text($("#pilih_project_masuk").find(":selected").text());
        $("#pilih_project_masuk").val(id);
        
        table_listPemasukkan();
    }

    function table_listPemasukkan() {
        var id = $("#pilih_project_masuk").find(":selected").val();
        //console.log(id);
        $('#table_listPemasukkan').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: url_table_listPemasukkan + id,
                type: 'GET'
            },
            order: [
                [0, 'asc']
            ],
            columns: [
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
                    render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
                
                },
                {
                    data:'action',
                    name:'action',
                },
            ],
            
        });
    }

    $('body').on('click', '.editKasMasuk', function () {
        var product_id = $(this).data('id');
        console.log(product_id);
        $("#nama_tipe").text($("#pilih_project_masuk").find(":selected").text()+"/");
        $.get('/dev/product/detailPemasukkan' + '/' + product_id, function (data) {
            
            $('#id_detail_product_kas').val(data.id);
            $('#edit_jumlah').val(data.jumlah);
            $('#status_kas').val("Pemasukkan");
        })  
    });

    $('body').on('click', '.deleteKasMasuk', function () {
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
                    url: "/dev/product/deletePemasukkan" + '/' + id,
                    success: function (data) {
                        table_listPemasukkan();
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
// end of pemasukkanProduct.blade.php

//pengeluaranProduct.blade.php
    $("#pengeluaranProduct").on("submit",function (e) {
        e.preventDefault();
        console.log($(['name="action"']).attr('id'));
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
                else if (data.status == -1) { 
                    //$('#pengeluaranProduct')[0].reset();
                    var terpilih_before = $("#nama_project_dipilih_keluar").text();
                    $("#pilih_project_keluar").find(":selected").text(terpilih_before);
                    $('#tipe_pengeluaran').val(0);
                    $('#jumlah_keluar').val('');
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "warning",
                    });

                }
                else{
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                    });
                    table_listPengeluaran();
                    var terpilih_before = $("#nama_project_dipilih_keluar").text();
                    $("#pilih_project_keluar").find(":selected").text(terpilih_before);
                    $('#tipe_pengeluaran').val(0);
                    $('#jumlah_keluar').val('');
                    
                    
                }
            }
        });
    });


    function pilih_proyek_keluar() {
        $("#card_keluar").removeClass('d-none');

        var id = $("#pilih_project_keluar").find(":selected").val();
        $("#nama_project_dipilih_keluar").text($("#pilih_project_keluar").find(":selected").text());
        $("#pilih_project_keluar").val(id);
        table_listPengeluaran();
    }

    function table_listPengeluaran() {
        var id = $("#pilih_project_keluar").find(":selected").val();
        console.log(id);
        $('#table_listPengeluaran').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: url_table_listPengeluaran + id,
                type: 'GET'
            },
            order: [
                [0, 'asc']
            ],
            columns: [
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
                    render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
                
                },
                {
                    data:'action',
                    name:'action',
                },
            ],
            
        });
    }

    $('body').on('click', '.editKasKeluar', function () {
        var product_id = $(this).data('id');
        console.log(product_id);
        $("#nama_tipe").text($("#pilih_project_keluar").find(":selected").text()+"/");
        $.get('/dev/product/detailPemasukkan' + '/' + product_id, function (data) {
            $('#id_detail_product_kas').val(data.id);
            $('#edit_jumlah').val(data.jumlah);
            $('#status_kas').val("Pengeluaran");
        })  
    });

    $('body').on('click', '.deleteKasKeluar', function () {
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
                    url: "/dev/product/deletePengeluaran" + '/' + id,
                    success: function (data) {
                        table_listPengeluaran();
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
// end of pengeluaranProduct.blade.php

//ubahPemasukkan dan Pengeluaran -- Modal  ubahPemasukkan.blade.php
    $("#modal_ubahJumlah").on("submit",function (e) {
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
                    $('#modal_ubahJumlah')[0].reset();
                    //$('#modal_ubahJumlah').hide();
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                    table_listPemasukkan();
                    table_listPengeluaran();
                   
                }
            }
        });
    });
//end of ubahPemasukkan dan Pengeluaran -- Modal  ubahPemasukkan.blade.php