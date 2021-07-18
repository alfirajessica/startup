
<style>
    .card-lift:hover{
        border-color: #0a1931;
        border-width: 2px;
    }
</style>
@forelse ($list_project as $item)
<a href="{{ url('inv/startup/detailstartup', $item->id) }}">
    <div class="card shadow mb-3 card-lift hover" style="max-width: 1024px;">
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
                            <small class="text-muted">Tipe</small>
                            <div class="font-weight-bold ng-binding" >{{$item->name_category}} - {{$item->name}}</div>
                            </div>
                            
                            <div>
                            <div class="text-muted text-truncate"> </div>
                                <p class="card-text">
                                    <button class="btn btn-outline-default btn-sm disabled">{{$item->name_startup_tag}}</button>
                                    <button class="btn btn-outline-default btn-sm disabled">{{$item->name_subtag}}</button>
                                    
                                </p>
                            </div>
                        </div>
                    </p>
                   
                    <small class="card-text" style="color: black">{{substr($item->desc,0,80)}} ...</small>
                   
                </div>
            </div>
        </div>
    </div>  
</a>    
@empty
<p class="text-black font-weight-bold">Tidak ada project tersedia</p>
@endforelse

<div class="">
    {!! $list_project->links() !!}
</div>



