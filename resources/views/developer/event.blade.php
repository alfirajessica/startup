@extends('layouts.dev')
<style>
  .card{
  margin: 5% 0%;
}

.card-body{
  margin: 0% 0% 0% 3%;
  padding: 6% 0%;
}
</style>
@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-md-3">
            <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                <i class="fas fa-filter"></i>
                Filter By
            </a>
            
            <div class="collapse multi-collapse show bg-white" id="multiCollapseExample1">    
                <div class="card-body border-0"> <!-- card-body -->
                   
                    @include('units.search')
                    <hr>
                    
                    <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                      <h5>Tipe event<i class="fas fa-chevron-down float-right"></i> </h5>
                    </a>

                    <div class="collapse multi-collapse show" id="multiCollapseExample2">
                        <div class="form-group">
                          
                          <div id="checkbox_categoryDetail" class="form-check checkbox">
                            <input type="checkbox" name="held_check" class="held_check" class="form-check-input border-0" value="Online" > <label class="form-check-label">Online</label>
                          </div>
                          <div id="checkbox_categoryDetail" class="form-check checkbox">
                            <input type="checkbox" name="held_check" class="held_check" class="form-check-input border-0" value="Offline"> <label class="form-check-label">Offline</label>
                          </div>
                        </div>   
                    </div>    
                </div>  
            </div><!-- END COLLAPSE -->
        </div>

        <div id="user_data" class="col-md-9 justify-content-center">
          @include('developer.event.dataEvent')
        </div>

        
        
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script>
  //semua function ini ada pada /js/inv/startup.js

  //call function get_more_users untuk search dan filter
  const url_get_more_users ="{{ route('users.get-more-users') }}" + "?page=";

</script>
<script src="/js/dev/event.js"></script>
@endsection


