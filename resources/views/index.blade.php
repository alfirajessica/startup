@guest
@include('head')
<style>
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
    }
    .navbar{
        background-color:#0a1931;
    }
    .dropdown-menu{
        background-color:#0a1931;
    }
    .landing-page{
        background-color: #EFEFEF;
    }
    .jumbotron {
        background-color: none
    }
    
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
   .btn-link {
      text-decoration: none !important;
  }

</style>
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg position-sticky top-0 shadow py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
        <img src="/../images/Logo-Startupinow-used.png" class="navbar-brand-img" alt="...">
      </a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: #f7f3e9"></i></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ url('/home') }}">
                            <img src="/../images/Logo-Startupinow-used2.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                    </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
              <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('valuation') }}">{{ __('Valuation Tools') }}</a>
              </li>
          </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a type="button" class="btn btn btn-warning btn-block" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            
                @if (Route::has('register'))
                    <li class="nav-item">
                      <a type="button" class="btn btn btn-secondary btn-block" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
            @endguest
          </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  @if (Route::currentRouteName() != "valuation")
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

@include('units.newestEvent')
  @endif

    <!-- End Navbar -->
    <div class="wrapper">
        
        <main >
            @yield('content')
            
        </main>
       
    </div>
    
</body>

</html>

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

</script>

    @else 
    <script>window.location = "/home";</script>   
@endguest

