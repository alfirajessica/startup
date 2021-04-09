@extends('layouts.inv')

@section('content')
<div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(/argon/assets/img/theme/img-1-1200x1000.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello </h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container">
    <div class="row py-4">
        <div class="col-md-3">
            @include('investor.filterStartup')
        </div><!--end tabs -->
        
        <div class="col-md-9">
            <div class="card border-0 py-4">  
                <div class="form-group">
                    <label for="exampleSelect1">Sort By</label>
                    <select class="form-control" id="exampleSelect1">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                </div>    
                
                @foreach ($list_events as $item)
                <div class="card mb-3 card-lift--hover shadow" style="max-width: 1024px;">
                    <div class="row no-gutters">
                      <div class="col-md-4 mx-2 my-5 p-0">
                        <img
                            src="/uploads/event/{{$item->image}}"
                            alt="..."
                            class="img-fluid"
                        />
                  
                      </div>
                      <div class="col-md-7 p-0 m-0">
                        <div class="card-body">
                          <h5 class="card-title m-0">{{$item->name}}</h5>
                          <p class="card-text">{{substr($item->desc,0,40)}}</p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>                
                @endforeach
                <div class="row py-4">
                  <div class="col-md-12 d-flex justify-content-center">
                    {{ $list_events->links() }}
                  </div>
                </div>
            </div>  
        </div> <!--end of col-md-8 -->
    </div>
</div>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


@endsection
