@extends('layouts.inv')

@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row"> <!-- row -->
        @include('units.jumbotron')
    </div>
    <div class="row">
        <div class="col-md-4 mb-0"><!--col-md-4 -->
            <hr>
            <div class="card profile-card-3">
                <div class="background-block">
                    <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background"/>
                </div>
                <div class="profile-thumb-block">
                    <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                </div>
                <div class="card-content">
                <h2>Justin Mccoy<small>Designer</small></h3>
                <div class="icon-block"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"> <i class="fa fa-twitter"></i></a><a href="#"> <i class="fa fa-google-plus"></i></a></div>
                </div>
            </div>
            
        </div><!--end col-md-4 -->
        
        <div class="col-md-8"> <!--col-md-8 -->
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                </svg>
                <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>

            <div class="card border-0 py-4">
                <div class="card-body shadow">
                    <h5>Site Info</h5>
                    
                </div>
            </div>

            <div class="card border-0 py-2">
                <div class="card-body shadow">
                    <h5>About Product</h5>
                    
                </div>
            </div>
            
            <div class="card border-0">
                <div class="card-body shadow">
                    <h5>Financial</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" id="table_pegawai">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Revenue</th>
                                <th>Cost</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    <!-- AKHIR TABLE -->
                    </div>
                </div>
            </div>

            
        </div><!--end col-md-8 -->
    </div>
</div>




@endsection
