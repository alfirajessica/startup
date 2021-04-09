@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->

        <!-- row untuk filter-->
        <div class="row py-4">
            {{-- @include('developer.filterEvents') --}}
            <div class="col-md-12">
              <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                  <i class="fas fa-filter"></i>
                  Filter By
              </a>
              <div class="collapse multi-collapse show" id="multiCollapseExample1">  
                  <div class="card-body shadow border-1"> <!-- card-body -->
                      <div class="row">
                          <div class="col-md-6">
                             @include('units.search')
                          </div>  
                          <div class="col-md-6">
                              <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                                  <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
                              </a>
                              <div class="collapse multi-collapse" id="multiCollapseExample2">
                                  
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <select class="form-control" id="held" >
                                        <option value="1">Semua</option>
                                        <option value="Online">Online</option>
                                        <option value="Offline">Offline</option>
                                    </select>
                                    </label>
                                  </div>
          
                                  <div class="form-group">
                                    <div class="form-check checkbox" name="checkbox_categoryDetail">
                                  
                                    </div>
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

        <div id="user_data">
          @include('developer.event.dataEvent')
        </div>

        
        
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

  $('#held').on('change', function() {
          getMoreUsers();
  });

});

function getMoreUsers(page) {
      var search = $('#search_input').val();

      var held = $('#held option:selected').val();
      console.log(held);
      
      $.ajax({
        type: "GET",
        data: {
          'search_query':search,
          'held_query':held,
        },
        url: "{{ route('users.get-more-users') }}" + "?page=" + page,
        success:function(data) {
          $('#user_data').html(data);
          //console.log(data);
        }
      });
    }


</script>
