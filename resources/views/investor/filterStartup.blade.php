<a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
    <i class="fas fa-filter"></i>
    Filter By
</a>
<div class="collapse multi-collapse show" id="multiCollapseExample1">    
    <div class="card-body border-1"> <!-- card-body -->
        <div class="form-group">
            <label for="exampleInputEmail1">Cari</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <hr>
        </div>
           

        
        
        <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
            
            <label>Tipe <i class="fas fa-chevron-down float-right"></i> </label>
        </a>
        <div class="collapse multi-collapse show" id="multiCollapseExample2">
            <div class="form-group">
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
            </div>
            
            
        </div>
        <hr>  
        {{-- <div id="check-awesome" class="form-group checkbox">
            <input type="checkbox" id="History">
            <label for="History">
            </label>
        </div> --}}

      
        {{-- <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3"> 
            <h5>Umur  <i class="fas fa-chevron-down float-right"></i> </h5>
        </a>
        <div class="collapse multi-collapse" id="multiCollapseExample3">
            <input type="range" class="custom-range" id="customRange1">
        </div> --}}
    </div>
    
</div><!-- card-body --> 

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script type="text/javascript">

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