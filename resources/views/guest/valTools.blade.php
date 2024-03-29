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
    #accordion .card div[aria-expanded="true"]:before {
    font-family: 'FontAwesome';
    content: "\f078";
    vertical-align: middle;  
    }
    #accordion .card div[aria-expanded="false"]:before {
    font-family: 'FontAwesome';
    content: "\f077";
    vertical-align: middle;
    }
</style>

<link rel="stylesheet" href="/css/front.css">
<section class="section-header pb-8 pb-lg-13 mb-4 mb-lg-6 text-white" style="
background-color: #0a1931;padding-top: 6rem;
">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-2 mb-3">Apa itu Valuation Tools ?</h1>
                <p class="lead">Bagaimana seharusnya Anda memberi harga pada bisnis Anda? Gunakan alat online ini untuk menghitung nilai bisnis Anda dan dapatkan harga permintaan yang masuk akal.</p>
            </div>
        </div>
    </div>
    <div class="pattern bottom"></div>
</section>
<section class="section section-lg pt-0" style="
padding-bottom: 0rem;
">
    <div class="container mt-n7 mt-lg-n13 z-2">
        <form action="{{ route('valuation.addnew')}}" method="post" id="valtools" enctype="multipart/form-data">
            @csrf
        <div class="col-md-12" >
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h5 class="text-white">Masukkan email anda</h5>
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4" id="select_project">
                            <input type="email" name="email_user" id="" class="form-control form-control-alternative text-dark" placeholder="" aria-describedby="helpemail_user">    
                            <div class="input-group-append">
                                <button class="btn btn-default" type="button" id="simpanEmail" onclick="simpan_email()">Simpan</button>
                            </div>
                        </div>
                        <small id="helpemail_user" class="text-muted"></small>
                    </div> 
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</section>
<section class="section section-lg pt-0 " style="
margin-top: 10%; padding-bottom:1rem;
">
<div class="container">
  <div class="row justify-content-center mb-5 mb-lg-4">
      <div class="col-12 col-md-8 text-center  d-none" id="result_calc">        
        <div class="card">
            <div class="card-body">
                <h5>Business value</h5>
                <h4 id="result_value"></h4>
                <button class="btn btn-outline-default" target="_blank" onclick="btn_d_valuation()">Lihat hasil perhitungan</button> <br>
            </div>
        </div>        
      </div>
  </div>
  <div class="row">
    <div class="col-md-12 d-none" id="val_calc">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-default">Hitung Valuasi</button>
            </div>
        </div>

        <div class="row py-2">
            <input type="hidden" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">

            <div class="col-md-6">
                <div id="accordion">
                    <div class="card">
                        <div class="card border-0 shadow" id="headingOne">
                            <h5 class="mb-0">
                            <div class="btn btn-link" data-toggle="collapse" data-target="#collapseKeyInput" aria-expanded="true" aria-controls="collapseKeyInput">
                                Key input
                            </div>
                            </h5>
                        </div>
                  
                        <div id="collapseKeyInput" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Berapa profitmu tahun lalu ({{ now()->year-1 }}) - Net Profit</label>
                                    <input type="text" name="net_profit" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="50,000"   class="form-control form-control-alternative">
                                </div>
                                
                                <label for="">Masukkan Tingkat Pertumbuhan tahunan Anda untuk periode perkiraan 5 tahun kedepan ({{ now()->year }}-{{ now()->year+4 }}) - Growth Rate</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-4">
                                            <input type="tel" name="growth_rate" id="" class="form-control" placeholder="" data-type="number" aria-describedby="helpId" value="3.0" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sales_revenue">Masukkan total Pendapatan Penjualan untuk tahun keuangan terakhir yang dilaporkan ({{ now()->year-1 }}) - Sales Revenue</label>
                                    <input type="text" name="sales_revenue" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="100,000"   class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card border-0 shadow" id="headingTwo">
                            <h5 class="mb-0">
                            <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFixedAssets" aria-expanded="false" aria-controls="collapseFixedAssets">
                                Fixed Assets
                            </div>
                            </h5>
                        </div>
                        <div id="collapseFixedAssets" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="">Masukkan nilai perkiraan pembelian Aset Tetap Baru yang Anda rencanakan selama 4 tahun ke depan (Purchases of New Fixed Assets)</label>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year }}</label>
                                                <input type="text" name="n_purchase_new_assets_[1]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_purchase_new_assets_[1]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+1 }}</label>
                                                <input type="text" name="n_purchase_new_assets_[2]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="5,000"   class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_purchase_new_assets_[2]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+2 }}</label>
                                                <input type="text" name="n_purchase_new_assets_[3]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="20,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_purchase_new_assets_[3]_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+3 }}</label>
                                                <input type="text" name="n_purchase_new_assets_[4]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_purchase_new_assets_[4]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+4 }}</label>
                                                <input type="text" name="n_purchase_new_assets_[5]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_purchase_new_assets_[5]_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Berapa total biaya untuk Beban Penyusutan aset tetap untuk tahun buku terakhir yang Anda laporkan? (Depreciation on existing assets)</label>
                                        <input type="text" name="depreciation_exist_assets" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="5,000" class="form-control form-control-alternative">
                                      
                                        <span class="text-danger error-text depreciation_exist_assets_error"></span>
                                        </div>

                                        <label for="">Berapa rata-rata Tingkat Penyusutan (%) tahunan untuk Aktiva Tetap baru selama 5 tahun ke depan? (Depreciation Rate(%))</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative mb-4">
                                            <input type="tel" name="depreciation_rate" id="" class="form-control" placeholder="" data-type="number" aria-describedby="helpId" value="20" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text depreciation_rate_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card border-0 shadow" id="headingThree">
                            <h5 class="mb-0">
                            <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseWorkCap" aria-expanded="false" aria-controls="collapseWorkCap">
                                Working Capital
                            </div>
                            </h5>
                        </div>
                        <div id="collapseWorkCap" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Current Assets</label>
                                    <input type="text" name="current_assets" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="40,000" class="form-control form-control-alternative">
                                    <span class="text-danger error-text current_assets_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Current Liabilities</label>
                                    <input type="text" name="current_liabilities" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="20,000" class="form-control form-control-alternative">
                                    <span class="text-danger error-text current_liabilities_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card border-0 shadow" id="headingFour">
                            <h5 class="mb-0">
                            <div class="btn btn-link" data-toggle="collapse" data-target="#collapseNonOpAs" aria-expanded="true" aria-controls="collapseNonOpAs">
                                Non Operating Assets
                            </div>
                            </h5>
                        </div>
                  
                        <div id="collapseNonOpAs" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="">Pinjaman dikembalikan (Loans returned)</label>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year }}</label>
                                            <input type="text" name="n_loans_returned_[1]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_loans_returned_[1]_error"></span>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+1 }}</label>
                                            <input type="text" name="n_loans_returned_[2]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_loans_returned_[2]_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+2 }}</label>
                                            <input type="text" name="n_loans_returned_[3]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_loans_returned_[3]_error"></span>
                                        </div>
                                    </div>
                                   
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+3 }}</label>
                                                <input type="text" name="n_loans_returned_[4]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_loans_returned_[4]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+4 }}</label>
                                                <input type="text" name="n_loans_returned_[5]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_loans_returned_[5]_error"></span>
                                            </div>
                                        </div>
                                    </div>
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
                        <div class="card border-0 shadow" id="headingFive">
                            <h5 class="mb-0">
                            <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseBorrow" aria-expanded="false" aria-controls="collapseBorrow">
                                Borrowing
                            </div>
                            </h5>
                        </div>
                        <div id="collapseBorrow" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="">Pinjaman perkiraan yang akan dilakukan (New Loans Taken) </label>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year }}</label>
                                                <input type="text" name="n_new_loan_[1]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_new_loan_[1]_error"></span>
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+1 }}</label>
                                                <input type="text" name="n_new_loan_[2]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_new_loan_[2]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+2 }}</label>
                                                <input type="text" name="n_new_loan_[3]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_new_loan_[3]_error"></span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+3 }}</label>
                                                <input type="text" name="n_new_loan_[4]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_new_loan_[4]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+4 }}</label>
                                                <input type="text" name="n_new_loan_[5]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="0" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_new_loan_[5]_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card border-0 shadow" id="headingSix">
                            <h5 class="mb-0">
                            <div class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCostEqu" aria-expanded="false" aria-controls="collapseCostEqu">
                                Cost of Equity
                            </div>
                            </h5>
                        </div>
                        <div id="collapseCostEqu" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Masukkan cost of equity</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <input type="tel" name="cost_equity" id="" class="form-control" placeholder="" data-type="number" aria-describedby="helpId" value="15" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        </div>
                                        <span class="text-danger error-text cost_equity_error"></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card border-0 shadow" id="headingSeven">
                            <h5 class="mb-0">
                            <div class="btn btn-link" data-toggle="collapse" data-target="#collapseSDE" aria-expanded="true" aria-controls="collapseSDE">
                                Seller's Discretionary Expenditure
                            </div>
                            </h5>
                        </div>
                  
                        <div id="collapseSDE" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year }}</label>
                                            <input type="text" name="n_seller_discretionary_expend_[1]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_seller_discretionary_expend_[1]_error"></span>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+1 }}</label>
                                            <input type="text" name="n_seller_discretionary_expend_[2]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_seller_discretionary_expend_[2]_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label for="">{{ now()->year+2 }}</label>
                                            <input type="text" name="n_seller_discretionary_expend_[3]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                            <span class="text-danger error-text n_seller_discretionary_expend_[3]_error"></span>
                                        </div>
                                    </div>
                                   
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+3 }}</label>
                                                <input type="text" name="n_seller_discretionary_expend_[4]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_seller_discretionary_expend_[4]_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                                <label for="">{{ now()->year+4 }}</label>
                                                <input type="text" name="n_seller_discretionary_expend_[5]" id="currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="10,000" class="form-control form-control-alternative">
                                                <span class="text-danger error-text n_seller_discretionary_expend_[5]_error"></span>
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
    </form>
  </div>
  
  </div>
</div>
</section>

<script>
    $("input[data-type='currency']").on({
        keyup: function() {
        formatCurrency($(this));
        },
        blur: function() { 
        formatCurrency($(this), "blur");
        }
    });


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = left_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += "";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
function simpan_email() { 
  
    if ( $("input[name='email_user']").val() == "") {
        
        $("#helpemail_user").text('silakan isi email');
        
    }else{
        $('#simpanEmail').prop('disabled', true);
        $("input[name='email_user']").attr('readonly', true);
        $("input[name='email']").text($("input[name='email']").val());
        $("#helpemail_user").text("");
        $("#val_calc").removeClass('d-none');
    }
   
    
}

$("#valtools").on("submit",function (e) {
   
   e.preventDefault();
  
   $.ajax({
       url:$(this).attr('action'),
       method:$(this).attr('method'),
       data:new FormData(this),
       processData:false,
       dataType:'json',
       contentType:false,
       beforeSend:function() {
           $(document).find('span.error-text').text('');
       },
       success:function(data) {
           if (data == 0) {
               $.each(data.error, function (prefix, val) {
                   $('span.'+prefix+'_error').text(val[0]);
               });
           }
           else{
               var result = parseInt(data);
                $("#result_value").text("Rp"+result.toLocaleString());
               console.log(data);
                $("#result_calc").removeClass('d-none');
           }
       }
   });
});

function btn_d_valuation() { 
    var email = $("input[name='email_user']").val();
    window.open("/valuation/cetak_hasilValuation/"+email);
}
</script>
<script type="text/javascript" src="../js/tawk.js"></script>