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
            title: "Apakah anda yakin ingin menghapus ini?",
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
                        swal("Poof! Anda berhasil menghapus data pemasukkan!", {
                            icon: "success",
                        });
                        table_listPemasukkan();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            } else {
                //swal("Your imaginary file is safe!");
            }
        });
    });
// end of pemasukkanProduct.blade.php

//pengeluaranProduct.blade.php
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
            title: "Apakah anda yakin ingin menghapus ini?",
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
                        swal("Poof! Anda berhasil menghapus data pengeluaran ini!", {
                            icon: "success",
                        });
                       
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                
            } else {
                //swal("Your imaginary file is safe!");
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
                if (data == 1) {
                    $('#ubahJumlah').modal('hide');
                    $('#modal_ubahJumlah')[0].reset();
                    swal("Poof! Anda berhasil mengubah!", {
                        icon: "success",
                    });
                    table_listPemasukkan();
                    table_listPengeluaran();
                }
                else {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
            }
        });
    });
//end of ubahPemasukkan dan Pengeluaran -- Modal  ubahPemasukkan.blade.php