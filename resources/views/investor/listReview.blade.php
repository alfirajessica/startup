@extends('layouts.inv')

@section('content')
<div class="container">
    
    <div class="col-md-12 py-2">
    <!-- card -->
    <div class="card">
      <div class="card shadow border-0">
      <div class="card-body"> <!-- card body -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" id="table_listReviews">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Project</th>
                        <th>Rating & Review</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <!-- AKHIR TABLE -->
        </div>
      </div> <!--end of card body -->
      </div>
    </div>
    <!-- end card -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
{{-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.24/sorting/datetime-moment.js"></script>     --}}
<script>
    const url_table_listReviews = "/inv/riwayatReview/listReviews";
</script>
<script src="/js/inv/review.js"></script>
@endsection

