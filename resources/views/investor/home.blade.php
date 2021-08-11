@include('layouts.inv')

<link rel="stylesheet" href="/css/front.css">

<section class="section-header pb-8 pb-lg-13 mb-4 mb-lg-6 text-white" style="
background-color: #0a1931;padding-top: 8rem;
">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-2 mb-3">Apa itu StartupINow. ?</h1>
                <p class="lead">Kumpulan-kumpulan Startup dari Developer Terbaik, dan Jadilah Angel Investor pada Startup</p>
            </div>
        </div>
    </div>
    <div class="pattern bottom"></div>
</section>
<section class="section section-lg pt-0" style="
padding-bottom: 0rem;
">
    <div class="container mt-n7 mt-lg-n13 z-2">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card shadow-soft border-light animate-up-3 text-gray py-4 mb-5 mb-lg-0">
                    <div class="card-header text-center pb-0">
                        <div class="icon icon-shape icon-shape-primary rounded-circle mb-3">
                          <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h4 class="text-black">Developer</h4>
                        
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex px-0 pt-0 pb-2">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Listing Startup atau Produk yang telah dibangun</div>
                            </li>
                            <li class="list-group-item d-flex px-0 pb-1">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Bangun & kembangkan afiliasi dan kemitraan dengan Investors</div>
                            </li>
                            <li class="list-group-item d-flex px-0 pb-1">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Hitung nilai bisnis dengan Valuation Tools</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-soft bg-white border-light animate-up-3 text-gray py-4 mb-5 mb-lg-0">
                    <div class="card-header text-center pb-0">
                        <div class="icon icon-shape icon-shape-primary rounded-circle mb-3">
                            <i class="fas fa-donate"></i>
                        </div>
                        <h4 class="text-black">Investor</h4>
                        
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex px-0 pt-0 pb-2">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Membuka event, mengumpulkan para Startup</div>
                            </li>
                            <li class="list-group-item d-flex px-0 pb-1">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Investasikan startup/produk pada Katalog Startup</div>
                            </li>
                            <li class="list-group-item d-flex px-0 pb-1">
                                <div class="icon icon-sm icon-success mr-4">
                                    <i class="far fa-check-circle"></i>
                                </div>
                                <div>Hitung nilai bisnis dengan Valuation Tools</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="section section-lg pt-0 line-bottom-light" style="
margin-top: 10%; padding-bottom:1rem;
">
<div class="container">
  <div class="row justify-content-center mb-5 mb-lg-4">
      <div class="col-12 col-md-8 text-center">
          <h1 class="display-3 mb-4">Get started in 30 seconds</h1>
          <p class="lead">Even if you have the most loyal customers ever, they’ll still want to know how things are going and for new users how to start.</p>
      </div>
  </div>
  <div class="row">
    @include('units.trendingStartup')
  </div>
  
  </div>
</div>
</section>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>

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
//  const url_eventPassed = @json(route('eventPassed'));
</script>
<script src="/js/custom.js"></script>