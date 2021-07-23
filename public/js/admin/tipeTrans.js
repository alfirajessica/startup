$(function () {
    table1();
});

    function table1() {
        $('#table_typeTrans').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/typeTrans",
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
                    data: null,
                    name: 'tipe',
                    className: 'dt-body-center',
                    render: data => {
                        if (data.tipe == "1") {
                            return "Pemasukkan";
                        }else{
                            return "Pengeluaran";
                        }
                    }
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-danger btn-sm nonAktifTypeTrans">Nonaktifkan</a>';
                        }else{
                            action += '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'+data.id+'" data-original-title="Delete" class="btn btn-success btn-sm aktifTypeTrans">Aktifkan</a>';
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

    $('body').on('click', '.editTypeTrans', function () {
        var id = $(this).data('id');
        $('#collapseCategory').collapse('show');

        //document.querySelector('#addCategory').classList.add('d-none');
        $.get("/admin/typeTrans/editTypeTrans" + '/' + id, function (data) {
            $('#edit_type_ID').val(id);
            var tipeheader = data.tipe;
            if (tipeheader == "1") {
                $('#tipeTrans').val("Pemasukkan");
            }else{
                $('#tipeTrans').val("Pengeluaran");
            }
            
            $('#edit_type_ket').val(data.keterangan);
            console.log(data.tipe);
        })
    });

    $("#addNewtypeTrans").on("submit",function (e) {
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
                        title: "Tipe Berhasil ditambahkan",
                        icon: "success",
                    });
                    $('#addNewtypeTrans')[0].reset();
                    $("#addNewtypeTrans").attr('data-dismiss','modal');
                    table1();
                }
                else if (data == -1) {
                    $('#addNewtypeTrans')[0].reset();
                    swal({
                        title: "Tipe Telah tersedia",
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

    $("#editTypeTrans").on("submit",function (e) {
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
                        title: "Berhasil mengubah tipe",
                        icon: "success",
                    });
                     $('#editTypeTrans')[0].reset();
                     $("#editModal").modal('hide');
                     table1();
                }
                else if (data == -1) {
                    swal({
                        title: "Tipe Telah tersedia",
                        icon: "warning",
                    });
                }
                else{
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
            }
        });
    });

    //nonaktifkan
    $('body').on('click', '.nonAktifTypeTrans', function () {
        var id = $(this).data("id");
        var txt;
        swal({
            title: "Apakah anda yakin ingin menonaktifkan tipe ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: "/admin/typeTrans/nonAktifTypeTrans" + '/' + id,
                    success: function (data) {
                        if (data == 0) {
                            swal("Poof! tipe sedang digunakan!", {
                                icon: "warning",
                            });
                        }else{
                            swal("Berhasil menonaktifkan tipe ini", {
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
     $('body').on('click', '.aktifTypeTrans', function () {
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
                    url: "/admin/typeTrans/aktifTypeTrans" + '/' + id,
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