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
                    data: 'name_category',
                    name: 'name_category'
                },
                {
                    data: null,
                    name: 'status',
                    className: 'dt-body-center',
                    render: data => {
                        if (data.status == "1") {
                            return "Aktif";
                        }else{
                            return "Tidak Aktif";
                        }
                    }
                },
                {
                    data:null,
                    name:'action',
                    render: data => {
                        var action="";
                       
                        if (data.status == 1) {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonAktifKategori">Nonaktifkan</a>';
                        }else{
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-success btn-sm aktifKategori">Aktifkan</a>';
                        }
                        return data.action + action;
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
                
                if (data == 1) {
                    swal({
                        text: "Kategori baru berhasil ditambahkan",
                        icon: "success",
                    });
                     $('#addNewCategoryProduct')[0].reset();
                     table1();
                }
                else if (data == -1) {
                    $('#addNewCategoryProduct')[0].reset();
                    swal({
                        text: "Kategori telah tersedia",
                        icon: "warning",
                    });
                }
                else {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                
            }
        });
    });

    $('body').on('click', '.detailKategori', function () {
        var id = $(this).data("id");
        var title = $(this).data("text");
        table2(id);
        $('#categoryID').val(id);
        $("#title_kategori").text("List Subkategori pada " + title);
        
    });

    //nonaktifkan
    $('body').on('click', '.nonAktifKategori', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            text: "Apakah anda yakin ingin menonaktifkan kategori ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/kategoriProduk/nonAktifKategori" + '/' + id,
                    success: function (data) {
                        if (data == 0) {
                            swal("Poof! kategori sedang digunakan!", {
                                icon: "warning",
                            });
                        }else{
                            swal("Anda berhasil menonaktifkan kategori ini", {
                                icon: "success",
                            });
                        }
                        
                        table1();
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

    //aktifkan
    $('body').on('click', '.aktifKategori', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            text: "Apakah anda yakin mengaktifkan kembali?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/kategoriProduk/aktifKategori" + '/' + id,
                    success: function (data) {
                        table1();
                        if (data == 1) {
                            swal("Berhasil mengaktifkan kembali", {
                                icon: "success",
                            });
                        }
                       
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
                        text: data.msg,
                        icon: "warning",
                    });
    
                }
                else{
                    $('#editModal').modal('hide');
                    $('#editCategoryProduct')[0].reset();
                    table1();
                    swal({
                        text: data.msg,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: null,
                    name: 'status',
                    className: 'dt-body-center',
                    render: data => {
                        if (data.status == "1") {
                            return "Aktif";
                        }else{
                            return "Tidak Aktif";
                        }
                    }
                },
                
                {
                    data:null,
                    name:'action',
                    render: data => {
                        var action="";

                        if (data.status == 1) {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonaktifDetailKategori">Nonaktifkan</a>';
                        }else{
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-success btn-sm aktifDetailKategori">Aktifkan</a>';
                        }
                        return data.action + action;
                    }
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
                        text: data.msg,
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
                        text: data.msg,
                        icon: "success",
                    });
                }
            }
        });
    });

    //nonaktifkan detail kategori - sub kategori
    $('body').on('click', '.nonaktifDetailKategori', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            text: "Apakah anda yakin menonaktifkan sub kategori ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/kategoriProduk"+'/nonaktifDetailKategori' + '/' + id,
                    success: function (data) {
                        if (data == 0) {
                            swal("Subkategori sedang digunakan!", {
                                icon: "warning",
                            });
                        }else{
                            var idkategori = $("#categoryID").val();
                            table2(idkategori);
                            swal("Berhasil menonaktifkan subkategori!", {
                                icon: "success",
                            });
                        }
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

    //aktifkan detail kategori - sub kategori
    $('body').on('click', '.aktifDetailKategori', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            text: "Apakah anda yakin mengaktifkan sub-kategori ini kembali?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/kategoriProduk/aktifDetailKategori" + '/' + id,
                    success: function (data) {
                        table1();
                        if (data == 1) {
                            var idkategori = $("#categoryID").val();
                            table2(idkategori);
                            swal("Berhasil mengaktifkan kembali", {
                                icon: "success",
                            });
                        }
                       
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