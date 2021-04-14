<div class="card border-0">
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
    </div>
    <img id="previewImg2" class="d-block user-select-none" width="100%" height="400" src="/uploads/event/{{$item->image}}" >
                </a>
    <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
</div>

<div class="card border-0 py-4">
    <div class="card-body shadow">
        <h5>Site Info</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="">Tipe</label>
                  <div class="font-weight-bold text-truncate ng-binding">{{$item->name_category}}-{{$item->name}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Rilis</label>
                    <div class="font-weight-bold text-truncate ng-binding">{{$item->rilis}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Net Profit</label>
                    <div class="font-weight-bold text-truncate ng-binding">Rp 0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 py-2">
    <div class="card-body shadow">
        <h5>About Product</h5>
        <div class="row">
            <div class="col-md-12">
                <p style="font-size:10pt">
                    <strong for="">Desc</strong> <br>
                    {{$item->desc}}
                <p>

                <p style="font-size:10pt">
                    <strong for="">Team</strong> <br>
                    {{$item->team}}
                <p>

                <p style="font-size:10pt">
                    <strong for="">Reason</strong> <br>
                    {{$item->reason}}
                <p>
        
                <p style="font-size:10pt">
                    <strong for="">Benefit</strong> <br>
                    {{$item->benefit}}
                <p>

                <p style="font-size:10pt">
                    <strong for="">Solusi</strong> <br>
                    {{$item->solution}}
                <p>
            </div>
            
        </div>
    </div>
</div>
