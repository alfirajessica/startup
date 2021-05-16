//ini semua function di admin/developer/Daftar Developer
$(function () {
    table1();
});
function table1() {
    $('#table_listDev').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: url_table_listDev,
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
  