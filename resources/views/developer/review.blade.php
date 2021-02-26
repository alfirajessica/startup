@extends('layouts.dev')

@section('content')
<div class="container">
    <div class="py-4"></div>
     <!-- card shadow -->
      <div class="row"> <!-- row -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" id="table_pegawai">
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
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>


<script>
  $(document).ready(function () {
        //  table1();
      });

   function table1() {
     $('#table_pegawai').DataTable({
               processing: true,
               serverSide: true, //aktifkan server-side 
               responsive:true,
               deferRender:true,
               aLengthMenu:[[10,20,50],[10,20,50]], //combobox limit
               ajax: {
                   url: "{{ route('admin.dev.listDev') }}",
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
     
</script>
@endsection

