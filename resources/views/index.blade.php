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
        background-color: #f7f3e9;
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
  <section class="bg-primary" style="min-height: 100vh; min-width: auto">
    <div class="content-wrapper">
        <h2>Oke</h2>
        
        <p class="content-subtitle">
            <span class="scroll-btn">
            <div class="scroll-to-next-section">
                <button class="btn btn-info"><i class="fas fa-chevron-down fa-lg"></i></button>
            </div>
            </span>
        </p>
    </div>
  </section>
  
  
  <section style="height: 100vh">
    <div class="col-md-12 py-6"><div class="row"></div></div>
    
    
  
    
  </section>
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
   if($('.scroll-to-next-section').length>0) {
   $(".scroll-to-next-section button").click(function () {
      $('html, body').animate({
         scrollTop: $(this).closest("section").next().offset().top
      }, "slow");
   });
}

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

