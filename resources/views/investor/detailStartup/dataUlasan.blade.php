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
                {{$item->created_at}}
            </span>

        <p class="be-comment-text">
            {{$item->rating}}/5 <br>
            {{$item->isi_review}}
        </p>
        <span>
            <a href="http://" class="text-right">Reply</a>
        </span>
        
    </div>
</div>
<hr>
@endforeach