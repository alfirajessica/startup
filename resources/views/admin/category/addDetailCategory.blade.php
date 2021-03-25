<form action="{{ route('admin.addNewDetailCategoryProduct') }}" method="POST" id="addNewDetailCategoryProduct">
    @csrf
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Kategori Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="categoryID" name="categoryID"/>

                <div id="alert_success2" class="alert alert-success d-none">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
                {{-- <div id="alert_danger2" class="alert alert-danger d-none">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div> --}}

                <div class="form-group">
                  <label for="detailcategory_product" class="col-form-label">Detail Kateogri Produk:</label>
                  <input type="text" class="form-control" name="detailcategory_product">
                  <span class="text-danger error-text detailcategory_product_error"></span>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
          </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    
});


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
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "warning",
                });
                $('#addNewDetailCategoryProduct')[0].reset();
            }
            else{
                $('#addNewDetailCategoryProduct')[0].reset();
                $("#addNewDetailCategoryProduct").modal('hide');
                //$("#addNewDetailCategoryProduct").attr('data-dismis', 'modal');
                var id = $("#categoryID").val();
                table2(id);
                swal({
                    title: data.msg,
                    text: "You clicked the button!",
                    icon: "success",
                });
            }
        }
    });
});
</script>