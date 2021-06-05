$(function () {
    table_allListProductDev();
});
function table_allListProductDev() {
    $('#table_allListProductDev').DataTable({
        destroy:true,
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
                            statusnya = "Menunggu Konfirmasi";
                        }
                        else if (data.status == "3") {
                            statusnya = "Dinonaktifkan Dev";
                        }
                        else{
                            statusnya = "Aktif";
                        }
                        return statusnya;
                    }
                  
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

$('body').on('click', '.detailProject', function () {
    var id = $(this).data('id');
    table_detailProjectTerdata(id);
    
   });

function table_detailProjectTerdata(id) { 
    $('#table_detailProjectTerdata').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/admin/dev/allListProduct/detail/" + id,
            type: 'GET'
        },
        columns: [
            {
                data: 'invest_id',
                name: 'invest_id',
                
            },
            {
                data: 'name',
                name: 'name',
              
            },
            {
                data: null,
                name: 'invest_expire',
                render: data => {
                    return moment(data.invest_expire).format('DD/MMM/YYYY');
                }
            },
            {
                data: 'jumlah_final',
                name: 'jumlah_final',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp')
              
            },
            {
                data: null,
                name: 'status_invest',
                render: data => {
                    if (data.status_invest == "5") {
                        return "Berakhir";
                    }else if (data.status_invest == "1") {
                        return "Aktif";
                    }
                    else if (data.status_invest == "4") {
                        return "Di cancle";
                    }else{
                        return "Menunggu Konfirmasi";
                    }
                    
                }
            },
        ],
        order: [
            [0, 'asc']
        ]
    });
 }
  