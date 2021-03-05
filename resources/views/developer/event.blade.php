@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            @include('units.jumbotron')
        </div>
        <!-- row untuk filter-->
        <div class="row">
            <div class="col-md-12">
                <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    <i class="fas fa-filter"></i>
                    Filter By
                </a>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">  
                    <div class="card-body border-1"> <!-- card-body -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cari</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div> 
                            </div>  
                            <div class="col-md-6">
                                <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                                    <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
                                </a>
                                <div class="collapse multi-collapse" id="multiCollapseExample2">
                                    
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                                        Display value
                                      </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>  
                    </div>
                </div>
            </div>
            
            
        </div>
        <!-- end row untuk filter-->
        <div class="row">
            <section class="pt-2 pb-5">
                <div class="container">
                    {{-- row event baru --}}
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                      @foreach ($header_events as $item)
                      <div class="col py-2">
                        <div class="card shadow border-0 h-100">
                          <img
                            src="/uploads/event/{{$item->image}}"
                            class="card-img-top"
                            alt="..."
                          />
                          <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">
                              {{$item->desc}}
                            </p>
                            <a href="{{ route('dev.event.detailsEvent')}}" class="btn btn-primary">Detail Event</a>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      </div>
                      
                    {{-- end of row event baru --}}
                    <div class="row py-4">
                      <div class="col-md-12 d-flex justify-content-center">
                        {{ $header_events->links() }}
                      </div>
                      
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
$(document).ready(function () {

});
</script>
