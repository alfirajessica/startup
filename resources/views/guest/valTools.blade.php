@guest
    @include('index')
    @else 
        @if (Auth::user()->role ==1 )
            @include('layouts.dev')

        @elseif(Auth::user()->role ==2)
            @include('layouts.inv')
        @endif     
@endguest

<style>
    .content-wrapper {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
            -ms-flex-pack: center;
                justify-content: center;
        text-align: center;
        -webkit-flex-flow: column nowrap;
            -ms-flex-flow: column nowrap;
                flex-flow: column nowrap;
        color: #fff;
        font-family: Montserrat;
        text-transform: uppercase;
        -webkit-transform: translateY(40vh);
            -ms-transform: translateY(40vh);
                transform: translateY(40vh);
        will-change: transform;
        -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
        -webkit-transition: all 1.7s cubic-bezier(0.22, 0.44, 0, 1);
                transition: all 1.7s cubic-bezier(0.22, 0.44, 0, 1);
    }
    
    #accordion .card-header button[aria-expanded="true"]:before {
    font-family: 'FontAwesome';
    content: "\f078";
    vertical-align: middle;  
    }
    #accordion .card-header button[aria-expanded="false"]:before {
    font-family: 'FontAwesome';
    content: "\f077";
    vertical-align: middle;
    }
    .btn-link {
        text-decoration: none !important;
    }

</style>

<section class="bg-primary" style="min-height: 100vh; min-width: auto">
    <div class="content-wrapper">
        <h2>Oke</h2>
        {{-- <p class="content-title">Full Page Parallax Effect</p> --}}
        <p class="content-subtitle">
            <span class="scroll-btn">
            <div class="scroll-to-next-section">
                <button class="btn btn-info"><i class="fas fa-chevron-down fa-lg"></i></button>
            </div>
            </span>
        </p>
    </div>
</section>

<form action="{{ route('valuation.addnew')}}" method="get">
<section style="height: 100vh">
    <div class="col-md-12 py-6"><div class="row"></div></div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                   <h4>Business value</h4>
                   <a href="#" target="_blank">Lihat lampiran</a>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row mx-3">
            <div class="col-md-12 px-2">
                <button type="submit" class="btn btn-primary">Hitung</button>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-6">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseKeyInput" aria-expanded="true" aria-controls="collapseKeyInput">
                                Key input
                            </button>
                            </h5>
                        </div>
                  
                        <div id="collapseKeyInput" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Berapa profitmu tahun lalu {{ now()->year-1 }}</label>
                                    <input type="number" name="net_profit" id="" class="form-control" placeholder="" aria-describedby="helpId" value="100000" required pattern="^\d+(\.|\,)\d{2}$">
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Masukkan Tingkat Pertumbuhan tahunan Anda untuk periode perkiraan {{ now()->year }}-{{ now()->year+3 }}</label>
                                    <input type="number" name="growth_rate" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFixedAssets" aria-expanded="false" aria-controls="collapseFixedAssets">
                                Fixed Assets
                            </button>
                            </h5>
                        </div>
                        <div id="collapseFixedAssets" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="">Masukkan nilai perkiraan pembelian Aset Tetap Baru yang Anda rencanakan selama 4 tahun ke depan.</label>
                                        <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year }}</label>
                                                <input type="number" name="n_purchase_new_assets_[1]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                                <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+1 }}</label>
                                                <input type="number" name="n_purchase_new_assets_[2]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                                <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+2 }}</label>
                                                <input type="number" name="n_purchase_new_assets_[3]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                                <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+3 }}</label>
                                                <input type="number" name="n_purchase_new_assets_[4]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                                <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Berapa total biaya untuk Beban Penyusutan aset tetap untuk tahun buku terakhir yang Anda laporkan?</label>
                                        <input type="number" name="depreciation_exist_assets" id="" class="form-control" placeholder="" aria-describedby="helpId" value="20000" required>
                                        <small id="helpId" class="text-muted">Help text</small>
                                        </div>

                                        <label for="">Berapa rata-rata Tingkat Penyusutan (%) tahunan untuk Aktiva Tetap baru selama 4 tahun ke depan?</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-4">
                                            <input type="number" name="depreciation_rate" id="" class="form-control" placeholder="" aria-describedby="helpId" value="20" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseWorkCap" aria-expanded="false" aria-controls="collapseWorkCap">
                                Working Capital
                            </button>
                            </h5>
                        </div>
                        <div id="collapseWorkCap" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Current Assets</label>
                                    <input type="number" name="current_assets" id="" class="form-control" placeholder="" aria-describedby="helpId" value="40000" required>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                                <div class="form-group">
                                    <label for="">Current liabilities</label>
                                    <input type="number" name="current_liabilities" id="" class="form-control" placeholder="" aria-describedby="helpId" value="20000" required>
                                    <small id="helpId" class="text-muted">Help text</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- end of accordion 1 --}}
            </div>
            
            {{-- accordion 2 --}}
            <div class="col-md-6">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseNonOpAs" aria-expanded="true" aria-controls="collapseNonOpAs">
                                Non Operating Assets
                            </button>
                            </h5>
                        </div>
                  
                        <div id="collapseNonOpAs" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <label for="">Loans returned</label>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year }}</label>
                                            <input type="number" name="n_loans_returned_[1]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+1 }}</label>
                                            <input type="number" name="n_loans_returned_[2]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+2 }}</label>
                                            <input type="number" name="n_loans_returned_[3]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+3 }}</label>
                                            <input type="number" name="n_loans_returned_[4]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseBorrow" aria-expanded="false" aria-controls="collapseBorrow">
                                Borrowing
                            </button>
                            </h5>
                        </div>
                        <div id="collapseBorrow" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <label for="">Pinjaman perkiraan yang akan dilakukan </label>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year }}</label>
                                            <input type="number" name="n_new_loan_[1]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+1 }}</label>
                                            <input type="number" name="n_new_loan_[2]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+2 }}</label>
                                            <input type="number" name="n_new_loan_[3]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+3 }}</label>
                                            <input type="number" name="n_new_loan_[4]" id="" class="form-control" placeholder="" aria-describedby="helpId" value="0" required>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCostEqu" aria-expanded="false" aria-controls="collapseCostEqu">
                                Cost of Equity
                            </button>
                            </h5>
                        </div>
                        <div id="collapseCostEqu" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Masukkan cost of equity</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <input type="number" name="cost_equity" id="" class="form-control" placeholder="" aria-describedby="helpId" value="15" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end of accordion 2 --}}
        </div>
    </div>
</section>
</form>
 <script>
     if($('.scroll-to-next-section').length>0) {
   $(".scroll-to-next-section button").click(function () {
      $('html, body').animate({
         scrollTop: $(this).closest("section").next().offset().top
      }, "slow");
   });
}
 </script>