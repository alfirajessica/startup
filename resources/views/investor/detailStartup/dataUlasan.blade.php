@foreach ($list_reviews as $item)
<div class="be-comment">
    <div class="be-img-comment">	
        <a href="blog-detail-2.html">
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="be-ava-comment">
        </a>
    </div>
    <div class="be-comment-content">
            <span class="be-comment-name">
                <a href="blog-detail-2.html">{{$item->name}}</a>
                </span>
            <span class="be-comment-time">
                <i class="fa fa-clock-o"></i>
                {{ \Carbon\Carbon::parse($item->created_at)->format('d/M/Y h:m')}}
               
            </span>
    </div>

    <div class="card-header">
        
        Rating : {{$item->rating}}/5 <br>
        Review : {{$item->isi_review}}
    </div>
</div>
<hr>
@endforeach