{{-- data event baru diambil dari 2 minggu dari sekarang --}}
<div class="row">
    
    <div class="col-6">
        <h5 class="mb-3">Event Baru</h5>
    </div>
    <div class="col-6 text-right">
        <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
        </a>
        <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
        </a>
    </div>
    
    <div class="col-12">
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach (array_slice($header_events->toArray(), 0, 4) as $item)
                        <div class="col py-2">
                            <div class="card shadow border-0 h-100">
                              <img
                                src="/uploads/event/{{$item->image}}"
                                class="card-img-top"
                                alt="..."
                              />
                              <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">
                                    {{ $item->desc }}
                                </p>
                                <a href="#" class="btn btn-primary">Detail Event</a>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
              
                <div class="carousel-item">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach (array_slice($header_events->toArray(), 4, 4) as $item)
                            <div class="col py-2">
                                <div class="card shadow border-0 h-100">
                                <img
                                    src="/uploads/event/{{$item->image}}"
                                    class="card-img-top"
                                    alt="..."
                                />
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text">
                                        {{ $item->desc }}
                                    </p>
                                    <a href="#" class="btn btn-primary">Detail Event</a>
                                </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <a class="mb-3" href="#">Lihat semua</a>
    </div>
</div>