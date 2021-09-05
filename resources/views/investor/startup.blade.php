@extends('layouts.inv')
<style>
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
<!-- Page content -->
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
                            <div class="card-body mb-0" style="padding:1.0rem;">
                              <div class="form-group text-dark">
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
                                <hr style="margin: 0px;">
                              </div>
                            </div>
                        </div>
                    </div>
                    {{-- end of filter tipe kategori --}} 

                    {{-- filter startup tag --}}
                    <div id="accordion">
                      <div class="card border-0" id="headingTwo">
                          <h5 class="mb-0">
                          <div class="btn btn-link btn-block" data-toggle="collapse" data-target="#collapseKeyInput2" aria-expanded="true" aria-controls="collapseKeyInput2" style="padding:0;text-align: left;">
                            Startup Tag
                          </div>
                          </h5>
                      </div>
                
                      <div id="collapseKeyInput2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body" style="padding:1.0rem;">
                            <div class="form-group text-dark">
                              @foreach($list_startupTag as $startupTag)
                              <label class="form-check-label" for="exampleCheck2">{{$startupTag->name_startup_tag}}
                                <div class="form-group ">                  
                                @foreach($list_SubstartupTag as $substartupTag)
                                  @if ($substartupTag->startuptag_id == $startupTag->id)
                                  <div id="checkbox_SubstartupTag" class="form-check checkbox">
                                    <input type="checkbox" name="check_SubstartupTag" id="check_SubstartupTag" class="form-check-input border-0" value="{{$substartupTag->id}}"> <label class="form-check-label">{{$substartupTag->name_subtag}}</label>
                                  </div>
                                  @endif
                                @endforeach
                                </div>
                              </label> <br>
                              @endforeach
                            </div>
                          </div>
                      </div>
                  </div>
                  {{-- end of filter startup tag--}} 
              </div>  
          </div><!-- END COLLAPSE --> 

        </div><!--end tabs -->
        
        <div id="user_data" class="col-md-9 justify-content-center py-2">
            <div class="card border-0 py-3" style="background-color: #EFEFEF">  
                
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

<script>
  //semua function ini ada pada /js/inv/startup.js

  //call function get_more_users untuk search dan filter
  const url_get_more_users ="{{ route('inv.get-more-startups') }}" + "?page=";

  //call function show_detail saat memilih/menekan salah satu card startup
  const url_show_detail = "{{ route('inv.startup') }}" + '/';
</script>
<script src="/js/inv/startup.js"></script>
{{-- <script src="../js/custom.js"></script> --}}
<script type="text/javascript" src="../js/tawk.js"></script>

