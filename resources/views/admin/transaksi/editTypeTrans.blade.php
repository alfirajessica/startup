<form action="{{ route('admin.updateTypeTrans') }}" method="POST" id="editTypeTrans">
    @csrf
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel" ></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                  <input type="text" id="edit_type_ID" name="edit_type_ID" />
                  <input type="text" id="tipeTrans" />
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Keterangan</label>
                  <input type="text" class="form-control" id="edit_type_ket" name="edit_type_ket">
                  <span class="text-danger error-text edit_type_ket_error"></span>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
    </div>
    </form>
    
    <script type="text/javascript">
    
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
                  if (data.status == 0) {
                      $.each(data.error, function (prefix, val) {
                          $('span.'+prefix+'_error').text(val[0]);
                      });
                  }
                  else if (data.status == -1) { 
                      //$('#addNewCategoryProduct')[0].reset();
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
                       $('#editTypeTrans')[0].reset();
                       $("#editTypeTrans").modal('hide');
                      // attr('data-dismiss','modal');
                       table1();
                  }
              }
          });
      });
    </script>