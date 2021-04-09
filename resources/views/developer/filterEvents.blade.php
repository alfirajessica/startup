<div class="col-md-12">
    <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
        <i class="fas fa-filter"></i>
        Filter By
    </a>
    <div class="collapse multi-collapse show" id="multiCollapseExample1">  
        <div class="card-body shadow border-1"> <!-- card-body -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cari</label>
                        <input type="text" name="search_input" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" onchange="search()">
                    </div> 
                </div>  
                <div class="col-md-6">
                    <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                        <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
                    </a>
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        
                        <div class="form-check">
                          <label class="form-check-label">
                            <select class="form-control" name="checkbox_categoryHeader" id="checkbox_categoryHeader" onchange="show_detail(this)">
        
                              @foreach($list_category as $category)
                              <option value="{{$category->id}}"> {{$category->name_category}}</option>
                              @endforeach
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


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">

function search() { 
    var get = $('[name="search_input"]').val();
    console.log(get);

    $.ajax({
      type: "get",
      url: 'event/searchEvent/' + get,
      success: function(result){
        //$('#ajaxtable').html(result);
        console.log(result);
      },
      error: function(result){
        console.log(result);
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

                    
             $('div[name="checkbox_categoryDetail"]').append('<label class="form-check-label" > <input class="form-check-input border-0" type="checkbox" value="'+ idnya + '"/>' + isi + '</label> <br>');
            
         }
  
     })

}

</script>