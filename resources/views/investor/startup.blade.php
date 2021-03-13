@extends('layouts.inv')

@section('content')
<div class="container">
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            @include('units.jumbotron')
        </div>
        <div class="row">
            <div class="col-md-4">
                @include('investor.filterStartup')
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

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


@endsection
