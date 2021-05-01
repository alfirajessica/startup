$(function () {
    table_listInvestConfirmYet();
});


function table_listInvestConfirmYet() { 
    $('#table_listInvestConfirmYet').DataTable({
        destroy:true,
        processing: true,
        serverSide: true, //aktifkan server-side 
        responsive:true,
        deferRender:true,
        aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
        ajax: {
            url: url_table_listInvestConfirmYet,
            type: 'GET',
        },
        order: [
            [0, 'asc']
        ],
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'invest_id',
                name: 'invest_id',
              
            },
            {
                data: 'jumlah',
                name: 'jumlah',
              
            },
            {
                data: 'action',
                name: 'action',
            },
            
        ],
        
    });

 }


 $('body').on('click', '.confirmInvest', function () {
    var id = $(this).data("id");
    console.log(id);
    var txt;
    swal({
        title: "Are You sure want to delete?",
        text: "Once deleted, you will not be able to recover this project!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "get",
                url: url_table_listInvestConfirmYet_confirmInvest + id,
                success: function (data) {
                    table_listInvestConfirmYet();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            //jika sukses, call swal
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
        });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
});