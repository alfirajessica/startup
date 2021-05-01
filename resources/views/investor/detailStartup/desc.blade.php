<div class="card border-0">
    <div class="card-body">
        <div class="row">
            @if (session('fail'))
                <script>
                    $(document).ready(function () {
                        swal("{{ session('fail') }}", "You clicked the button!", "warning");
                    });
                </script>
            @endif
            <div class="col-md-8">
                <h1 id="id_product">{{$item->id}}</h1>
                <h5 class="card-title" name="name_project" id="name_project">{{$item->name_product}}</h5>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Investasikan</button>
            </div>
        </div>
        
    </div>
    <img id="previewImg2" class="d-block user-select-none" width="100%" height="400" src="/uploads/event/{{$item->image}}" >
                </a>
    
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
                    <div class="font-weight-bold text-truncate ng-binding">
                        {{ \Carbon\Carbon::parse($item->rilis)->format('d/M/Y')}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Link</label>
                    <a href="{{$item->url}}">{{$item->url}}</a>
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

{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="invest-invest_number" class="col-form-label">Message:</label>
              <input type="number" inputMode='decimal' name="invest_number" id="invest_number" placeholder="min:500.000" onFocus="this.type='number'; this.value=this.lastValue" 
              onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString()"/>
              <small id="notif_invest_number"></small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="pay-button" onclick="payButton()">Investasikan</button>
        </div>
      </div>
    </div>
</div>
{{-- end of modal --}}

<form id="payment-form" method="GET" action="Payment">
    <input type="hidden" name="result_data" id="result_data" value="" />
</form>

<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-cOQK7kRXSSPSVE3Y"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 

<script type="text/javascript">

    //function saat menekan tombol Investasikan pada modal
    const url_pay = '/inv/investTo/';

</script>

<script src="/js/inv/invest.js"></script>

