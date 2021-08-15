@extends('layouts.dev')
<style>
  /* .card{
  margin: 5% 0%;
}

.card-body{
  margin: 0% 0% 0% 3%;
  padding: 6% 0%;
} */
#accordion .card div[aria-expanded="true"]:before {
    font-family: 'FontAwesome';
    content: "\f078";
    vertical-align: middle;  
    }
    #accordion .card div[aria-expanded="false"]:before {
    font-family: 'FontAwesome';
    content: "\f077";
    vertical-align: middle;
    }
    .btn-link {
        text-decoration: none !important;
    }
</style>
@section('content')
<div class="container">
  <div class="row py-4">
    <div class="col-md-3">
        <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
          <i class="fas fa-filter"></i>
          <strong style="text-dark">Filter</strong>  
        </a>
      <div class="collapse multi-collapse show bg-white" id="multiCollapseExample1">    
          <div class="card-body shadow border-1"> <!-- card-body -->
             
                @include('units.search')
                <hr style="margin-top:1px;">
                {{-- filter tipe kategori --}} 
                <div id="accordion">
                    <div class="card border-0" id="headingOne">
                        <h5 class="mb-0">
                        <div class="btn btn-link btn-block" data-toggle="collapse" data-target="#collapseKeyInput" aria-expanded="true" aria-controls="collapseKeyInput" style="padding:0;text-align: left;">
                            Tipe
                        </div>
                        </h5>
                    </div>
              
                    <div id="collapseKeyInput" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body mb-0" style="padding:0rem;">
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
                </div>
                {{-- end of filter tipe kategori --}} 
          </div>  
      </div><!-- END COLLAPSE --> 

    </div><!--end tabs -->
    
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
<script src="../js/custom.js"></script>
<script type="text/javascript" src="../js/tawk.js"></script>
@endsection


