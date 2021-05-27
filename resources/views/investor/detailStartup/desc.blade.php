<div class="card border-0">
    <div class="card-body px-0" style="background-color: #f7f3e9">
        <div class="row">
           <div class="col-md-8  mb-0">
                @if (session('fail'))
                <script>
                    $(document).ready(function () {
                        swal("{{ session('fail') }}", "You clicked the button!", "warning");
                    });
                </script>
                @endif

                {{-- class="d-none" --}}
                <h1 id="id_product" name="id_product" class="d-none">{{$item->id}}</h1>
                <h5 class="card-title font-weight-bold" name="name_project" id="name_project">{{$item->name_product}}</h5>
                
                <img id="previewImg2" class="d-block user-select-none shadow" width="100%" max-height="400" src="/uploads/event/{{$item->image}}" > </a>
            </div>
            <div class="col-md-4 ">
               <div class="row py-2">
                   <div class="col-md-12">
                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Investasikan</button>
                   </div>
               
               </div>
                <div class="row py-2">
                    <div class="col-md-12">
                        <div class="card shadow border-0">
                            <div class="card-body ">
                                <h5>Site Info</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="">Tipe</label>
                                        <div class="font-weight-bold text-truncate ng-binding">{{$item->name_category}}-{{$item->name}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Rilis</label>
                                            <div class="font-weight-bold text-truncate ng-binding">
                                                {{ \Carbon\Carbon::parse($item->rilis)->format('d/M/Y')}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Link</label>
                                            <div class="font-weight-bold text-truncate ng-binding">
                                                <a href="{{$item->url}}">{{$item->url}}</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
           </div>
        </div>    
        
        <div class="row py-4">
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="about_product-tab" data-toggle="tab" href="#about_product" role="tab" aria-controls="about_product" aria-selected="true">Deskripsi Produk</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="about_product" role="tabpanel" aria-labelledby="about_product-tab">
                        <div class="card shadow border-0">
                            <div class="card-body">
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @foreach ($detail_user as $item)
                    <div class="card shadow text-center">
                        <div class="card-header">
                        Tentang Startup
                        </div>
                        <div class="card-body">
                        <h5>{{$item->name}}</h5>
                        <p class="card-text">{{$item->province_name}}, {{$item->city_name}}</p>
                        </div>  
                    </div>
                    
                    
                    {{-- @include('investor.detailStartup.profilStartup') --}}
                @endforeach

                @foreach ($reviews as $review)
                <div class="card shadow text-center py-2">
                        
                    <div class="card-body">
                        <h3 style='font-size:24pt;'>{{$review->rate}} <span style='font-size:18pt;'> /5 </span></h3>
                        <?php 
                            $rate = $review->rate;
                            $sisa = 5 - $rate;
                            $star = "";
                            if ($rate == 0) {
                                $star = "Belum ada ulasan";
                            }
                            else if ($rate != 0){
                                $star = "<div class='stars' data-rating='0'>";
                                for ($i=0; $i < $rate ; $i++) { 
                                    $star= $star."<span class='star rated' data-rating='".$i."'>&nbsp;</span>";
                                }
                                for ($i=0; $i <$sisa; $i++) { 
                                    $star= $star."<span class='star' data-rating='".$i."'>&nbsp;</span>";
                                }
                                $star = $star."</div>";
                                
                            }
                            echo $star;
                        ?>
                        <p class="card-text">{{$review->ulasan}} Ulasan</p>
                    </div>  
                </div>
                @endforeach
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-8">
                @include('investor.detailStartup.financial')
            </div>
        </div>
        <div class="row py-2">
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">Review & Comments</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="card shadow border-0 py-2">
                            <div class="card-body">
                                <div id="data_ulasan">
                                    @include('investor.detailStartup.dataUlasan')
                                </div>
                                
                        
                                @include('investor.detailStartup.ulasan')
                            </div> 
                        </div>
                    </div>
                </div>
                
                {{-- @include('investor.detailStartup.ulasan') --}} 
                {{-- @foreach ($reviews as $item)
                    @include('investor.detailStartup.ulasan')
                @endforeach --}}
            </div>
        </div>
    </div>
</div>


{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog bg-secondary" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="invest-invest_number" class="col-form-label">Jumlah Yang Akan di Investasikan (Rp) :</label>
              <input type="number" inputMode='decimal' name="invest_number" id="invest_number" placeholder="min:500.000" onFocus="this.type='number'; this.value=this.lastValue" 
              onBlur="this.type=''; this.lastValue=this.value; this.value=this.value==''?'':(+this.value).toLocaleString()" class="form-control form-control-alternative"/>
              <small id="notif_invest_number"></small>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Durasi Anda Investasi :</label>
                <select name="durasi_inv" id="durasi_inv" class="form-control">
                    <option value="3">3 Bulan</option>
                    <option value="6">6 Bulan</option>
                </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
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

