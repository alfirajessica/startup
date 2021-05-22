<form action="{{ route('inv.beriReview')}}" method="POST" enctype="multipart/form-data" id="beriReview">
    @csrf

    <input type="hidden" id="project_id_ulas" name="project_id_ulas" value="{{$item->id}}">
    <label for=""> Beri Rating</label>
    <div class='stars' data-rating='0'>
        <span class='star rated' data-rating='1'>&nbsp;</span>
        <span class='star' data-rating='2'>&nbsp;</span>
        <span class='star' data-rating='3'>&nbsp;</span>
        <span class='star' data-rating='4'>&nbsp;</span>
        <span class='star' data-rating='5'>&nbsp;</span>
    </div>

    <div class="form-group">
        <label for="">Komentar Anda</label>
        <textarea class="form-control" name="isi_review" id="isi_review" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-info float-right">Submit</button>
</form>


<script src="/js/inv/review.js"></script>