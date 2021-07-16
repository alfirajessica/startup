$(function () {
    table1();
});

//tabel semua hstartup tag
    function table1() {
        $('#table_hStartupTag').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/startupTags",
                type: 'GET'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name_startup_tag',
                    name: 'name_startup_tag'
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
                    data:null,
                    name:'action',
                    render: data => {
                        var action="";

                        if (data.status == 1) {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonAktifHStartupTag">Nonaktifkan</a>';
                        }else{
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm aktifHStartupTag">Aktifkan</a>';
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

    $("#addNewHStartupTag").on("submit",function (e) {
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
                        title: "Kategori baru berhasil ditambahkan",
                        icon: "success",
                    });
                     $('#addNewHStartupTag')[0].reset();
                     table1();
                }
                else if (data == -1) {
                    $('#addNewHStartupTag')[0].reset();
                    swal({
                        title: "Kategori telah tersedia",
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

    $('body').on('click', '.editHStartupTag', function () {
        var id = $(this).data('id');
        $('#collapseCategory').collapse('show');
    
        $.get("/admin/startupTags" +'/editHStartupTag' + '/' + id, function (data) {
            $('#edit_HStartupTagID').val(id);
            $('#edit_HStartupTag').val(data.name_startup_tag);         
        })
    });

    $('body').on('click', '.detailHStartupTag', function () {
        var id = $(this).data("id");
        table2(id);
        $('#hStartupID').val(id);
    });

    $("#editHStartupTag").on("submit",function (e) {
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
                    $('#editHStartupTag')[0].reset();
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "warning",
                    });
    
                }
                else{
                    $('#editHStartupTags').modal('hide');
                    $('#editHStartupTag')[0].reset();
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

    //tabel detail kategori
    function table2(id) {
        $('#table_subStartupTag').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/startupTags"+'/showSubStartupTag' + '/' + id,
                type: 'GET'
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name_subtag',
                    name: 'name_subtag'
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
                    data:null,
                    name:'action',
                    render: data => {
                        var action="";

                        if (data.status == 1) {
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonAktifSubStartupTag">Nonaktifkan</a>';
                        }else{
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm aktifSubStartupTag">Aktifkan</a>';
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

    $("#addNewSubStartupTag").on("submit",function (e) {
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
                        icon: "warning",
                    });
                    $('#addNewSubStartupTag')[0].reset();
                }
                else if (data.status == 1){
                    $('#addNewSubStartupTag')[0].reset();
                    $("#addNewSubStartupTag").modal('hide');
                    var id = $("#hStartupID").val();
                    table2(id);
                    swal({
                        title: data.msg,
                        icon: "success",
                    });
                }
            }
        });
    });

    //nonaktifkan tag
    $('body').on('click', '.nonAktifHStartupTag', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah anda yakin ingin menonaktifkan tag ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/startupTags/nonAktifHStartupTag" + '/' + id,
                    success: function (data) {
                        if (data == 0) {
                            swal("Poof! tag sedang digunakan!", {
                                icon: "warning",
                            });
                        }else{
                            swal("Poof! Your imaginary file has been deleted!", {
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

    //aktifkan tag
    $('body').on('click', '.aktifHStartupTag', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah anda yakin mengaktifkan kembali?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/startupTags/aktifHStartupTag" + '/' + id,
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

    //nonaktifkan sub tag
    $('body').on('click', '.nonAktifSubStartupTag', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah anda yakin menonaktifkan sub tag ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/startupTags"+'/nonAktifSubStartupTag' + '/' + id,
                    success: function (data) {
                        if (data == 0) {
                            swal("Poof! sub tag sedang digunakan!", {
                                icon: "warning",
                            });
                        }else{
                            var idkategori = $("#hStartupID").val();
                            table2(idkategori);
                            swal("Poof! Berhasil menonaktifkan sub tag!", {
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
    $('body').on('click', '.aktifSubStartupTag', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah anda yakin mengaktifkan sub-tag ini kembali?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/startupTags/aktifSubStartupTag" + '/' + id,
                    success: function (data) {
                        table1();
                        if (data == 1) {
                            var idkategori = $("#hStartupID").val();
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