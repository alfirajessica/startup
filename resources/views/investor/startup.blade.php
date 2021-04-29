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
            {{-- @include('investor.filterStartup') --}}
            <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
              <i class="fas fa-filter"></i>
              Filter By
          </a>
          <div class="collapse multi-collapse show" id="multiCollapseExample1">    
              <div class="card-body border-1"> <!-- card-body -->
                 
                    @include('units.search')
                    <hr>
                  
                  <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                    <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
                  </a> 

                  <div class="collapse multi-collapse show" id="multiCollapseExample2">
                    <div class="form-group">

                      @foreach($list_category as $category)
                      <label class="form-check-label" for="exampleCheck1">{{$category->name_category}}
                        <div class="form-group ">
                        
                        @foreach($list_dtcategory as $category2)
                          @if ($category2->category_id == $category->id)
                          <div id="checkbox_categoryDetail" class="form-check checkbox">
                            <input type="checkbox" name="check_detailCat" class="form-check-input border-0" value="{{$category2->id}}"> <label class="form-check-label">{{$category2->name}}</label>
                          </div>
                          @endif
                        @endforeach

                        </div>
                      </label> <br>
                      @endforeach

                    </div>
                      
                  </div>
                  <hr> 
              </div>
              
          </div><!-- card-body --> 

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
                
                <div id="user_data">
                  @include('investor.detailStartup.dataStartup')
                </div>
                
                
            </div>  
        </div> <!--end of col-md-8 -->
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
  //semua function ini ada pada /js/inv/startup.js

  //call function get_more_users untuk search dan filter
  const url_get_more_users ="{{ route('inv.get-more-startups') }}" + "?page=";

  //call function show_detail saat memilih/menekan salah satu card startup
  const url_show_detail = "{{ route('inv.startup') }}" + '/';
</script>
<script src="/js/inv/startup.js"></script>

