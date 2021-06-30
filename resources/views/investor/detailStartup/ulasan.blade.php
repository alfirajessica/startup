<form action="{{ route('inv.beriReview')}}" method="POST" enctype="multipart/form-data" id="beriReview">
    @csrf

    <input type="hidden" id="project_id_ulas" name="project_id_ulas">
    <label for=""> Beri Rating</label>
    <div class='stars' data-rating='0'>
        <span class='star' data-rating='1'>&nbsp;</span>
        <span class='star' data-rating='2'>&nbsp;</span>
        <span class='star' data-rating='3'>&nbsp;</span>
        <span class='star' data-rating='4'>&nbsp;</span>
        <span class='star' data-rating='5'>&nbsp;</span>
    </div>
    <input type="hidden" id="stars_rating" name="stars_rating">
    <span class="text-danger error-text stars_rating_error"></span>

    <div class="form-group">
        <label for="">Komentar Anda</label>
        <textarea class="form-control" name="isi_review" id="isi_review" rows="3"></textarea>
        <span class="text-danger error-text isi_review_error"></span>
    </div>
    <button type="submit" class="btn btn-default float-right">Beri ulasan</button>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
{{-- semua function ini ada pada /js/inv/startup.js --}}
<script>
    $(function () {
        var id = {{ Request::route('id')}};
        console.log(id);
        $("#project_id_ulas").val(id);
    });
   
</script> 
<script src="/js/inv/review.js"></script>


