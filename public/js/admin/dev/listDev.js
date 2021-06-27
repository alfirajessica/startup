//ini semua function di admin/developer/Daftar Developer
$(function () {
    table1();
});

    function table1() {
        $('#table_listDev').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/dev/daftarDeveloper",
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
                    data: 'email',
                    name: 'email'
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

    $('body').on('click', '.detailDev', function () {
        var id = $(this).data('id');
        console.log('ini id dari modal' + id);

        $('#table_detailProjectTerdataDev').DataTable({
            destroy:true,
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: "/admin/dev/detailDev/"+id,
                type: 'GET',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: null,
                    name: 'created_at',
                    render: data => {
                        return moment(data.created_at).format('DD-MMM-YYYY');
                        
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
                        var status ="";
                        if (data.status == 1) {
                            status = "Aktif";
                        }
                        else if (data.status == 2) {
                            status = "Memiliki Investor";
                        }
                        else if (data.status == 3) {
                            status = "Di nonaktifkan";
                        }
                        return status;
                        
                    }
                },
                
            ],
            order: [
                [0, 'asc']
            ]
        });
        
    });
