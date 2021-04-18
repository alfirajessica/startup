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
                            <input type="checkbox" name="check_detailCat[]" class="form-check-input border-0" value="{{$category2->id}}"> <label class="form-check-label">{{$category2->name}}</label>
                          </div>
                          @endif
                        @endforeach

                        </div>
                      </label> <br>
                      @endforeach

                    </div>
                      {{-- <div class="form-group">
                          <label for=""></label>
                          <select class="form-control" name="checkbox_categoryHeader" id="checkbox_categoryHeader" onchange="show_detail(this)">
                              
                              @foreach($list_category as $category)
                              <option value="{{$category->id}}"> {{$category->name_category}}</option>
                              @endforeach
                          </select>
                      </div>
                      
                      <div class="form-group">
                          <div class="form-check checkbox" name="checkbox_categoryDetail">
                        
                          </div>
                      </div>  --}}
                  </div>
                  <hr>  

                  {{-- <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3">
                    <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
                  </a> 

                  <div class="collapse multi-collapse show" id="multiCollapseExample3">
                      <div class="form-group">
                          
                          @foreach($list_category as $category)
                          
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="category_checkbox" id="{{$category->id}}">
                            <label class="" for="{{$category->id}}">{{$category->name}}</label>
                          </div>
                          @endforeach
                          
                      </div>
                      
                      <div class="form-group">
                          <div class="form-check checkbox" name="checkbox_categoryDetail">
                        
                          </div>
                      </div> 
                  </div>
                   --}}
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



<script>
$(document).ready(function () {

  $('#search_input').on('keyup', function() {
    $value = $(this).val();
    getMoreUsers(1);
  });

  var checkboxes = $('input[name="check_detailCat[]"]');
  checkboxes.filter(":checked").map(function () {
    return this.value;
  }).get()
  
  //var typecategory = $('input[name="check_detailCat[]"]:checked').val();
 //     console.log(typecategory);

 
});

  // $('div[name="checkbox_categoryDetail"] input[type="checkbox"]').click(function(){
  //           if($(this).prop("checked") == true){
  //               console.log("Checkbox is checked.");
  //           }
  //           else if($(this).prop("checked") == false){
  //               console.log("Checkbox is unchecked.");
  //           }
  //       });

  // $('#check_detailCat').on('change', function() {
  //   getMoreUsers();
  // });



    function getMoreUsers(page) {
      var search = $('#search_input').val();

      var typecategory = $('input[name="category_check"]:checked').val();
      console.log(typecategory);
      
      $.ajax({
        type: "GET",
        data: {
          'search_query':search,
          'typecategory_query':typecategory,
        },
        url: "{{ route('inv.get-more-users') }}" + "?page=" + page,
        success:function(data) {
          $('#user_data').html(data);
        }
      });
    }

  function show_detail() { 
      
      var id = $('#checkbox_categoryHeader').val();
      console.log(id);
  
       $.get("{{ route('inv.startup') }}" + '/' + id, function (data) {
           //var place = document.getElementById('check-awesome');
           $('div[name="checkbox_categoryDetail"]').empty();
           for (let i = 0; i < data.list_detailcategory.length; i++) {
               console.log(data.list_detailcategory[i]["id"])
  
               var idnya = data.list_detailcategory[i]["id"];
               var isi = data.list_detailcategory[i]["name"];
  
                      
               $('div[name="checkbox_categoryDetail"]').append('<label id="typeCategory" class="form-check-label" > <input name="category_check" class="form-check-input border-0"  type="checkbox" value="'+ idnya + '"/>' + isi + '</label> <br>');

              //  $('div[name="checkbox_categoryDetail"]').append(
              //    '<input type="checkbox" name="category_check" class="category_checkbox" id="'+idnya+'"> <label class="form-check-label" for="'+idnya+'">' + isi + '</label>'
              //  );

             
              
           }
    
       })
  
  }
  
  </script>


