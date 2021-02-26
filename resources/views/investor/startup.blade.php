@extends('layouts.inv')

@section('content')
<div class="container">
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            @include('units.jumbotron')
        </div>
        <div class="row">
            <div class="col-md-4">
                <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    <i class="fas fa-filter"></i>
                    Filter By
                </a>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">    
                    <div class="card-body border-1"> <!-- card-body -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cari</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <hr>   

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
                        <hr>  

                        <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3"> 
                            <h5>Umur  <i class="fas fa-chevron-down float-right"></i> </h5>
                        </a>
                        <div class="collapse multi-collapse" id="multiCollapseExample3">
                            <input type="range" class="custom-range" id="customRange1">
                        </div>
                    </div>
                    
                </div><!-- card-body --> 
            </div><!--end tabs -->
            
            <div class="col-md-8">
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
                    
                    <div class="card shadow mb-4" style="max-width: 1024px">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img
                                src="/images/thumbnail.svg"
                                alt="..."
                                class="img-fluid"
                            />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <strong class="d-inline-block mb-2 text-success">[Tipe Produk]</strong>
                                    <h4 class="mb-0">
                                    <a class="text-dark" href="#">[Nama produk]</a>
                                    </h4>
                                    
                                    <p class="card-text mb-auto">[Deskripsi] This is a wider card with supporting text below as a natural lead-in to additional content....</p>
                                    <a href="{{route('detailstartup')}}">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="card shadow mb-4" style="max-width: 1024px">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img
                                src="/images/sample-img.png"
                                alt="..."
                                class="img-fluid"
                                style="width: 250px"
                            />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <strong class="d-inline-block mb-2 text-success">Design</strong>
                                    <h3 class="mb-0">
                                    <a class="text-dark" href="#">Post title</a>
                                    </h3>
                                    <div class="mb-1 text-muted">Nov 11</div>
                                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#">Continue reading</a>
                                </div>
                            </div>
                        </div>
                    </div>  

                </div>  
            </div> <!--end of col-md-8 -->
        
        </div>
    </div>
</div>




@endsection
