<div class="row py-2">
  @forelse ($header_events as $item)
 
    <div class="col-md-4 mb-5 mb-md-0 py-2">
     
      <div class="card card-lift--hover shadow border-0 py-2">
        <a src="/uploads/event/{{$item->image}}" title="Landing Page">
          <img src="/uploads/event/{{$item->image}}" class="card-img-top">
        </a>
        <div class="card-body">
          <h5 class="card-title">{{$item->name}}</h5>
          <p class="card-text">
            {{substr($item->desc,0,40)}}
            <a href="{{ route('dev.event.detailsEvent', ['id' =>$item->id]) }}" class="btn btn-outline-primary btn-sm">Detail Event</a>
          </p>
        </div>
      </div>
   
    </div>
  
  @empty
  <p class="text-black">Tidak ada event tersedia</p>
  @endforelse
</div>

<div class="">
  {{ $header_events->links() }}
</div>