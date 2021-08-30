<section class="section" style="
padding-top: 0rem; padding-bottom:0rem;
">
    <div class="container">
        <div class="row justify-content-center mbt-4">
            <div class="col-12 text-center">
                <h1 class="h1 font-weight-bolder mb-4 px-lg-8">Trending Startup</h1>
            </div>
        </div>
        <div class="row">
            @foreach ($trending_startup as $item)
               
                <div class="col-12 col-lg-4">
                    <a href="{{ url('inv/startup/detailstartup', $item->id) }}">
                        <div class="card shadow-soft border-light animate-up-3 text-gray py-0 mb-2 mb-lg-0 mt-2">
                            <div class="card-header text-center pb-0" style="padding: 0rem 0rem;">
                                <img  src="/uploads/event/{{$item->image}}" class="card-img-top" style="min-height: 150px;">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="text-black text-center">{{substr($item->name_product,0,20)}}</h4> 
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
  </section>