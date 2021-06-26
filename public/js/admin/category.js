$(function () {
    table1();
});

//tabel semua kategori
    function table1() {
        $('#table_category').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/kategoriProduk",
                type: 'GET'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name_category',
                    name: 'name_category'
                },
                {
                    data: null,
                    name: 'status',
                    render: data => {
                        if (data.status == "1") {
                            return "Aktif";
                        }else{
                            return "Tidak Aktif";
                        }
                    }
                },
                
                {
                    data: null,
                    name: 'action',
                    render: data => {
                        //cek apakah kategori tsb sedang digunakan oleh developer-produk
                        $.ajax({
                            type: "GET",
                            url:"/admin/kategoriProduk/cek/"+ data.id,
                            success:function(data) {
                              
                            }
                          });
                    }
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    }

    $("#addNewCategoryProduct").on("submit",function (e) {
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
                    $('#addNewCategoryProduct')[0].reset();
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
                     $('#addNewCategoryProduct')[0].reset();
                    // $("#addNewCategoryProduct").attr('data-dismiss','modal');
                     table1();
                }
            }
        });
    });

    $('body').on('click', '.detailKategori', function () {
        var id = $(this).data("id");
        table2(id);
        $('#categoryID').val(id);
    });

    $('body').on('click', '.deleteKategori', function () {
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
                    url: "/admin/kategoriProduk/deleteKategori" + '/' + id,
                    success: function (data) {
                        table1();
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

    $('body').on('click', '.editCategory', function () {
        var id = $(this).data('id');
        $('#collapseCategory').collapse('show');
    
        $.get("/admin/kategoriProduk" +'/editKategori' + '/' + id, function (data) {
            $('#edit_categoryID').val(id);
            $('#edit_category_product').val(data.name_category);
            console.log(data.name_category);
        })

    });

    $("#editCategoryProduct").on("submit",function (e) {
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
                    $('#editCategoryProduct')[0].reset();
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "warning",
                    });
    
                }
                else{
                    $('#editModal').modal('hide');
                    $('#editCategoryProduct')[0].reset();
                    table1();
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                    });
                }
            }
        });
    });
//end of tabel semua kategori

//tabel detail kategori
    function table2(id) {
        $('#table_detailcategory').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/kategoriProduk"+'/detailKategori' + '/' + id,
                type: 'GET'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'status',
                    render: data => {
                        if (data.status == "1") {
                            return "Aktif";
                        }else{
                            return "Tidak Aktif";
                        }
                    }
                },
                
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            order: [
                [0, 'asc']
            ]
        });
    }

    $("#addNewDetailCategoryProduct").on("submit",function (e) {
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
                if (data.status == -1) { 
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "warning",
                    });
                    $('#addNewDetailCategoryProduct')[0].reset();
                }
                else if (data.status == 1){
                    $('#addNewDetailCategoryProduct')[0].reset();
                    $("#addNewDetailCategoryProduct").modal('hide');
                    var id = $("#categoryID").val();
                    table2(id);
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                    });
                }
            }
        });
    });

    $('body').on('click', '.deleteDetailKategori', function () {
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
                    url: "/admin/kategoriProduk"+'/deleteDetailKategori' + '/' + id,
                    success: function (data) {
                        var idkategori = $("#categoryID").val();
                        table2(idkategori);
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
