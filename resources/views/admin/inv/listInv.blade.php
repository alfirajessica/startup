@extends('layouts.adm')

@section('content')
<div class="container">
  <div class="py-4"></div>
  <div class="row py-5">
        <div class="col-md-12">
          <div class="card shadow">
            <div class="table-responsive px-2 py-2">
              <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInv">
                <thead>
                    <tr style="text-align: center">
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
      {{-- </main> --}}
    </div>
</div>

@include('admin.inv.detailInv')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
  const url_table_listInv = @json(route('admin.inv.listInv'));
  //  const url_detailInvest = '/detailInvest' + '/';
  //   const url_detailStatusInvest = '/detailStatusInvest' + '/';
  //   const url_table_projectDetails = '/projectdetailInvest' + '/';
</script>

<script src="/js/admin/inv/listInv.js"></script>
<script>
  $("#list_inv").addClass('active');
</script>
@endsection