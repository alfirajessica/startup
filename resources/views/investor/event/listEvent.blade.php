<div class="row">
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
$(document).ready(function () {
  table_listEvent();
});


function table_listEvent() {
  $('#table_listEvent').DataTable({
      processing: true,
      serverSide: true, //aktifkan server-side 
      responsive:true,
      deferRender:true,
      aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
      ajax: {
          url: "{{ route('inv.listEvent') }}",
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
              data: 'held',
              name: 'held'
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

</script>