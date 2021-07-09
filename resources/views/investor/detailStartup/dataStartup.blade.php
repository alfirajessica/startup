
@forelse ($list_project as $item)
<a href="{{ url('inv/startup/detailstartup', $item->id) }}">
    <div class="card shadow mb-3 card-lift--hover" style="max-width: 1024px;">
        <div class="row no-gutters">
            <div class="col-md-4 mx-2 my-5 p-0">
                <img
                    src="/uploads/event/{{$item->image}}"
                    alt="..."
                    class="img-fluid"
                />
    
            </div>
            <div class="col-md-7 p-0 m-0 ">
                <div class="card-body">
                    <h5 class="card-title m-0 font-weight-bold">{{$item->name_product}}</h5>
                    <p class="card-text">
                        <div class="d-flex flex-nowrap justify-content-between">
                            <div>
                            <div class="text-muted">Tipe</div>
                            <div class="font-weight-bold text-truncate ng-binding">{{$item->name_category}} - {{$item->name}}</div>
                            </div>
                            
                            <div>
                            <div class="text-muted text-truncate"> </div>
                            
                            </div>
                        </div>
                    </p>
                    {{-- <a href="{{$item->url}}">{{$item->url}}</a> --}}
                    <p class="card-text" style="color: black">{{substr($item->desc,0,40)}} ...</p>
                    <p class="card-text"><small class="text-muted">{{$item->url}}</small></p>
                </div>
            </div>
        </div>
    </div>  
</a>    
@empty
<p class="text-black text-bold">Tidak ada project tersedia</p>
@endforelse

<div class="">
    {!! $list_project->links() !!}
</div>



