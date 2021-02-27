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
            @include('developer.event.listEvents')
        </div>
    </div>
</div>




@endsection
