<style>
  .card-img-top {
width: 100%;
height: 30vh;
object-fit: contain;
}
.card-lift:hover{
        border-color: #0a1931;
        border-width: 2px;
    }
</style>
<div class="row py-2">
  @forelse ($header_events as $item)
  
    <div class="col-md-4 mb-2 py-2">
      
      <div class="card card-lift hover py-1  h-100">
        <a href="{{ url('dev/event/detailsEvent', $item->id) }}">
          
            <img src="/uploads/event/{{$item->image}}" class="card-img-top">
          
          <div class="card-body">
            <h6 class="card-title">{{$item->name}}</h6>
            <p class="card-text">
          </div>
        </a>
      </div>
    
    </div>
 
  @empty
  <p class="text-black font-weight-bold">Tidak ada event tersedia</p>
  @endforelse
</div>

<div class="">
  {{ $header_events->links() }}
</div>