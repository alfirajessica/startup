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
                    name: 'tanggal',
                    render: data => {
                        return moment(data.tanggal).format('DD/MMM/YYYY')
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
            text: "Apakah anda yakin ingin menghapus ini?",
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
                    name: 'tanggal',
                    render: data => {
                        return moment(data.tanggal).format('DD/MMM/YYYY')
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
            text: "Apakah anda yakin ingin menghapus ini?",
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

$("input[data-type='currency']").on({
    keyup: function() {
    formatCurrency($(this));
    },
    blur: function() { 
    formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
// format number 1000000 to 1,234,567
return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
// appends $ to value, validates decimal side
// and puts cursor back in right position.

// get input value
var input_val = input.val();

// don't validate empty input
if (input_val === "") { return; }

// original length
var original_len = input_val.length;

// initial caret position 
var caret_pos = input.prop("selectionStart");

// check for decimal
if (input_val.indexOf(".") >= 0) {

// get position of first decimal
// this prevents multiple decimals from
// being entered
var decimal_pos = input_val.indexOf(".");

// split number by decimal point
var left_side = input_val.substring(0, decimal_pos);
var right_side = input_val.substring(decimal_pos);

// add commas to left side of number
left_side = formatNumber(left_side);

// validate right side
right_side = formatNumber(right_side);

// On blur make sure 2 numbers after decimal
if (blur === "blur") {
  right_side += "00";
}

// Limit decimal to only 2 digits
right_side = right_side.substring(0, 2);

// join number by .
input_val = left_side;

} else {
// no decimal entered
// add commas to number
// remove all non-digits
input_val = formatNumber(input_val);
input_val = input_val;

// final formatting
if (blur === "blur") {
  input_val += "";
}
}

// send updated string to input
input.val(input_val);

// put caret back in the right position
var updated_len = input_val.length;
caret_pos = updated_len - original_len + caret_pos;
input[0].setSelectionRange(caret_pos, caret_pos);
}