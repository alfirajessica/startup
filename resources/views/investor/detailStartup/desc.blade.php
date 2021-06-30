@extends('layouts.inv')

@section('content')
<div class="container">
    <div class="row">
        <nav>
            <ol class="breadcrumb fixed-top" style="top:60px;justify-content: center;z-index:2;">
                <li class="breadcrumb-item active"><a href="#produk">Produk</a></li>
                <li class="breadcrumb-item"><a href="#tentang_produk">Tentang Produk</a></li>
                <li class="breadcrumb-item"><a href="#financial">Keuangan</a></li>
                <li class="breadcrumb-item"><a href="#review">Review</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">

    <div class="row" >
        <div class="py-4"></div>
            <div class="col-md-12">
                
                @foreach ($list_project as $item)
                    {{-- image, desc site info, about product --}}
                    {{-- @include('investor.detailStartup.desc')  --}}
                    <div class="card border-0" id="produk">
                        <div class="card-body px-0" style="background-color: #f7f3e9" >
                    
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 id="id_product" name="id_product" class="d-none">{{$item->id}}</h1>
                                    <h4 class="card-title font-weight-bold py-4" name="name_project" id="name_project">{{$item->name_product}}</h4>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-8">
                                    @if (session('fail'))
                                    <script>
                                        $(document).ready(function () {
                                            swal("{{ session('fail') }}", "You clicked the button!", "warning");
                                        });
                                    </script>
                                    @endif
                    
                                    <img id="previewImg2" class="d-block user-select-none shadow" width="100%" max-height="500" src="/uploads/event/{{$item->image}}" > </a>
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
                                                    <h5>Informasi Produk</h5>
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
                            <div class="row"  ></div>
                            <div class="row py-4"  id="tentang_produk">
                                <div class="col-md-8" >
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="about_product-tab" data-toggle="tab" href="#about_product" role="tab" aria-controls="about_product" aria-selected="true">Tentang Produk</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="about_product" role="tabpanel" aria-labelledby="about_product-tab">
                                            <div class="card shadow border-0">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p style="font-size:10pt">
                                                                <strong for="">Deskripsi</strong> <br>
                                                                {{$item->desc}}
                                                            <p>
                                            
                                                            <p style="font-size:10pt">
                                                                <strong for="">Tim pada proyek</strong> <br>
                                                                {{$item->team}}
                                                            <p>
                                            
                                                            <p style="font-size:10pt">
                                                                <strong for="">Alasan pembuatan proyek ini</strong> <br>
                                                                {{$item->reason}}
                                                            <p>
                                                    
                                                            <p style="font-size:10pt">
                                                                <strong for="">Manfaat yang didapatkan</strong> <br>
                                                                {{$item->benefit}}
                                                            <p>
                                            
                                                            <p style="font-size:10pt">
                                                                <strong for="">Solusi yang ditawarkan</strong> <br>
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
                                    @endforeach
                    
                                    @foreach ($reviews as $review)
                                    <div class="card shadow text-center py-2">
                                            
                                        <div class="card-body">
                                            
                                            <h2 style='font-size:32pt;'>
                                                @if ($review->rate == 0)
                                                    0
                                                @else
                                                    {{$review->rate}}
                                                @endif
                                                 
                                                <span style='font-size:18pt;'> /5 </span>
                                            </h2>
                                            <?php
                                                $coba="<label> <div class='starsUlasan' data-rating='0'>";
                                                $data = $review->rate;
                                                $sisa = 5 - $data;
                    
                    
                                                for ($i=0; $i <$data; $i++) { 
                                                    $coba= $coba."<span class='starUlasan rated' data-rating='".$i."'>&nbsp;</span>";
                                                }
                                                for ($i=0; $i <$sisa; $i++) { 
                                                    $coba= $coba."<span class='starUlasan' data-rating='".$i."'>&nbsp;</span>";
                                                }
                                                $coba = $coba."</div>";
                                                echo $coba;
                                            ?>
                                           
                                            <p class="card-text">({{$review->ulasan}}) Ulasan</p>
                                        </div>  
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row py-2" id="financial">
                                <div class="col-md-8">
                                    @include('investor.detailStartup.financial')
                                </div>
                            </div>
                            <div class="row py-2" id="review">
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
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
//----------------stars rating ----------------------------------//
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            //target.dispatchEvent(new MouseEvent('click'));
        });

        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
        }
        //----------------end of stars rating ----------------------------------//
    //function saat menekan tombol Investasikan pada modal
    const url_pay = '/inv/investTo/';

</script>

<script src="/js/inv/invest.js"></script>

@endsection