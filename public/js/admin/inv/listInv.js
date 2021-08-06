$(function () {
    table1();
});
function table1() {
    $('#table_listInv').DataTable({
            processing: true,
            serverSide: true, //aktifkan server-side 
            responsive:true,
            deferRender:true,
            aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
            ajax: {
                url: url_table_listInv,
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
                    data: 'email',
                    name: 'email',
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

  $('body').on('click', '.detailInv', function () {
    var id = $(this).data('id');
    var title = $(this).data('text');
    $("#data_inv").text(title);
    console.log('ini id dari modal' + id);

    $('#table_detailInvestasiTerdataInv').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: "/admin/inv/detailInv/"+id,
            type: 'GET',
        },
        columns: [
            {
                data: null,
                name: 'invest_id',
                render: data => {
                    return "#"+data.invest_id;
                }
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
                data: 'jumlah_invest',
                name: 'jumlah_invest',
                className: 'dt-body-right',
                render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp' )
            },
            {
                data: null,
                name: 'status_invest',
                render: data => {
                    var status ="";
                    //status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif oleh inv), 4(tdk aktif krna gagal byr/cancle/expire), 5 (investasi sudah expire)
                    if (data.status_invest == 0) {
                        status = "Menunggu Konfirmasi Admin";
                    }
                    else if (data.status_invest == 1) {
                        status = "Aktif";
                    }
                    else if (data.status_invest == 2) {
                        status = "Di Nonaktifkan Inv";
                    }
                    else if (data.status_invest == 4) {
                        status = "Gagal/Dicancel";
                    }
                    else if (data.status_invest == 5) {
                        status = "Expire";
                    }
                    return status;
                    
                }
            },
            
        ],
    });
    
});
  