<a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
    <i class="fas fa-filter"></i>
    Filter By
</a>
<div class="collapse multi-collapse show" id="multiCollapseExample1">    
    <div class="card-body border-1"> <!-- card-body -->
        <div class="form-group">
            <label for="exampleInputEmail1">Cari</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <hr>   

        <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
            <h5>Tipe <i class="fas fa-chevron-down float-right"></i> </h5>
        </a>
        <div class="collapse multi-collapse" id="multiCollapseExample2">
            @foreach($list_category as $category)
            <div class="form-check">
              <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="checkbox_categoryHeader[]" value="{{$category->id}}"> {{$category->name_category}}</td>

                    {{-- nanti ini untuk dapetin list detail category  --}}
                    @foreach($list_category as $role)
                    <div class="form-check">
                    <input type="hidden" name="checkbox_categoryHeader_ID">
                    <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="checkbox_categoryHeader[]"> {{$role->name_category}}</td>
                    </label>
                    </div>
                    @endforeach

              </label>
            </div>
            @endforeach
        </div>
        <hr>  

        <a name="" id="" class="btn-block" data-toggle="collapse" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3"> 
            <h5>Umur  <i class="fas fa-chevron-down float-right"></i> </h5>
        </a>
        <div class="collapse multi-collapse" id="multiCollapseExample3">
            <input type="range" class="custom-range" id="customRange1">
        </div>
    </div>
    
</div><!-- card-body --> 