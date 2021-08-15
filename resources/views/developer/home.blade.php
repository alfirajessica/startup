@include('layouts.dev')

<link rel="stylesheet" href="/css/front.css">
<style>
   .arrow {
  text-align: center;
  margin: 8% 0;
}
.bounce {
  -moz-animation: bounce 2s infinite;
  -webkit-animation: bounce 2s infinite;
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-30px);
  }
  60% {
    transform: translateY(-15px);
  }
}
</style>
<section class="section-header pb-8 pb-lg-13 mb-4 mb-lg-10 text-white" style="
background-color: #0a1931;padding-top: 6rem;
">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-2 mb-3">Apa itu StartupINow. ?</h1>
                <p class="lead">Kumpulan-kumpulan Startup dari Developer Terbaik, dan Jadilah Angel Investor pada Startup</p>
                
                 <br>
                <a type="button" class="btn btn-outline-danger" href="{{ route('dev.product') }}">Klik Untuk Daftarkan Startup Anda</a>
                
                <div class="arrow bounce">
                    <a class="fa fa-arrow-down fa-1x" href="#"></a>
                    <h4>Lihat Event Terbaru</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="pattern bottom"></div>
</section>
<section class="section section-lg pt-0" style="
padding-bottom: 0rem;
">
    <div class="container mt-n7 mt-lg-n13 z-2">
        <div class="row justify-content-center mbt-4">
            <div class="col-12 text-center">
                <h1 class="h1 font-weight-bolder mb-4 px-lg-8 text-white">Event Terbaru</h1>
            </div>
        </div>
        <div class="row px-4 py-4">
            @foreach ($new_event as $item)
               
                <div class="col-12 col-lg-4">
                    <a href="{{ url('dev/event/detailsEvent', $item->id) }}">
                        <div class="card shadow-soft border-light animate-up-3 text-gray py-4 mb-2 mb-lg-0 mt-2">
                            <div class="card-header text-center pb-0" style="padding: 1.0rem 1.0rem;">
                                <img  src="/uploads/event/{{$item->image}}" class="card-img-top" style="min-height: 150px;">
                            </div>
                            <div class="card-body">
                                <div class="card-text">
                                    <h4 class="text-black text-center">{{substr($item->name,0,20)}}</h4> 
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
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
 //const url_eventPassed = @json(route('eventPassed'));
</script>
<script src="../js/custom.js"></script>
<script type="text/javascript" src="../js/tawk.js"></script>
