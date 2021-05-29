$(function () {
    table_allListProductDev();
});
function table_allListProductDev() {
    $('#table_allListProductDev').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: url_table_allListProductDev,
                type: 'GET'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
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
                            statusnya = "Tidak Aktif";
                        }
                        else if (data.status == "1") {
                            statusnya = "Aktif";
                        }
                        else{
                            statusnya = "Memiliki Investor";
                        }
                        return statusnya;
                    }
                  
                },
                {
                    data: 'status_invest',
                    name: 'status_invest',
                    
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
  