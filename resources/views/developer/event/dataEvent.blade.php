<div class="row py-2">
  @forelse ($header_events as $item)
  
    <div class="col-md-4 mb-5 mb-md-0 py-2">
      {{-- <a href="{{ url('dev/event/detailsEvent', $item->id) }}"> --}}
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
    {{-- </a> --}}
    </div>
  
    
  @empty
  <p class="bg-danger text-white p-1">No product</p>
  @endforelse
</div>

<div class="">
  {{ $header_events->links() }}
</div>