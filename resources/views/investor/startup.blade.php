@extends('layouts.inv')

@section('content')
<div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(/images/person-using-tablet.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container d-flex align-items-center">
        <div class="row">
            <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-black">Hello </h1>
            <p class="text-black mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
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
          <div class="collapse multi-collapse show bg-white" id="multiCollapseExample1">    
              <div class="card-body shadow border-1"> <!-- card-body -->
                 
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
                            <input type="checkbox" name="check_detailCat" id="check_detailCat" class="form-check-input border-0" value="{{$category2->id}}"> <label class="form-check-label">{{$category2->name}}</label>
                          </div>
                          @endif
                        @endforeach

                        </div>
                      </label> <br>
                      @endforeach

                    </div>   
                  </div>
              </div>  
          </div><!-- END COLLAPSE --> 

        </div><!--end tabs -->
        
        <div id="user_data" class="col-md-9 justify-content-center">
            <div class="card border-0 py-4" style="background-color: #f7f3e9">  
                
              <div class="alert alert-danger d-none" id="search_nullData" role="alert">
                <strong>Tidak ada </strong>
              </div>
                @include('investor.detailStartup.dataStartup')
               
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

