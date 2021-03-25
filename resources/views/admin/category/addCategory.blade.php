<form action="{{ route('admin.addNewCategoryProduct') }}" method="POST" id="addNewCategoryProduct">
@csrf
<div class="collapse show" id="collapseCategory">
    <div class="card card-body col-md-12">
        <label for="category_product" class="col-form-label">Kateogri Produk:</label>
        <div class="input-group">
            <input type="text" class="form-control" name="category_product" >
            <div class="input-group-append">
                <button name="action" type="submit" class="btn btn-primary" id="addCategory">Tambahkan</button>
            </div>
        </div>
        <span class="text-danger error-text category_product_error"></span>
    </div>
</div>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">

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
                 $("#addNewCategoryProduct").attr('data-dismiss','modal');
                 table1();
            }
        }
    });
});


</script>