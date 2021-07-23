@extends('layouts.adm')

@section('content')
<div class="container">
  <div class="py-4"></div>
  <div class="row py-5">
        <div class="col-md-12">
          <div class="card shadow">
            <div class="table-responsive px-2 py-2">
              <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listInvestConfirmYet">
                <thead>
                    <tr style="text-align: center">
                        <th>Dimuat</th>
                        <th>Id Invest</th>
                        <th>Jumlah Invest</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      {{-- </main> --}}
    </div>
</div>


{{-- modal detail dari transaksi investasi --}}
@include('admin.inv.detailTrans')
{{-- end of modal detail dari transaksi investasi --}}

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script src="/js/admin/inv/transaksi/listInvest.js"></script>
<script>
  $("#list_trans").addClass('active');
</script>

@endsection