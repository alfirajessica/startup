@extends('layouts.inv')
<style>
  .scroll {
  max-height: 400px;
  overflow-y: auto;
}
</style>
@section('content')
<div class="container">
    
    <div class="col-md-12 py-2">
      <h4><strong>Riwayat Ulasan</strong></h4>
    <!-- card -->
    <div class="card">
      <div class="card shadow border-0">
      <div class="card-body scroll"> <!-- card body -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_listReviews">
                <thead style="text-align: center">
                    <tr>
                        <th>#Id</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Rating & Review</th>
                        <th>Tanggapan</th>
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

<script>
    const url_table_listReviews = "/inv/riwayatReview/listReviews";
</script>
<script src="/js/inv/review.js"></script>
<script src="../js/custom.js"></script>
@endsection

