@extends('head')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
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
  </style>
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg position-sticky top-0 shadow py-2">
    <div class="container">
        <a class="navbar-brand mr-lg-5 text-white" href="{{ url('/home') }}">
            {{ config('app.name', 'Startup') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color: #f7f3e9"></i></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="../../../index.html">
                            <img src="../assets/img/brand/blue.png">
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
  <link href="/css/parallax.css" rel="stylesheet" />
        <section class="background up-scroll">
        <div class="content-wrapper">
          <p class="content-title">Full Page Parallax Effect</p>
          <p class="content-subtitle">
            <span class="scroll-btn">
                <a href="#">
                    <span class="mouse">
                        <span>
                        </span>
                    </span>
                </a>
              <p style="margin-top:40px">scroll me YEA</p>
            
            </span>
            
            </p>
        </div>
      </section>
      <section class="background" id="intro2">
        <div class="content-wrapper">
          <p class="content-title">Amazon forest</p>
          <p class="content-subtitle">All the rendered pixels are super reall</p>
        </div>
      </section>
      <section class="background">
        <div class="content-wrapper">
          <p class="content-title">Fireflies.</p>
          <p class="content-subtitle">Long-exposure photo of fireflies in a darkened Japanese forest</p>
        </div>
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
var ticking = false;
var isFirefox = (/Firefox/i.test(navigator.userAgent));

var scrollSensitivitySetting = 30; // Increase/decrease to change sensitivity to trackpad gestures (up = less sensitive; down = more sensitive) 

var slideDurationSetting = 600; 
// Amount of time for which slide is "locked"

var currentSlideNumber = 0;

var totalSlideNumber = $(".background").length;


function parallaxScroll(evt) {
  if (isFirefox) {
    // Set delta for Firefox
    delta = evt.detail * (-120);
  } else {
    // Set delta for all other browsers
    delta = evt.wheelDelta;
  }

  if (ticking != true) {
    if (delta <= -scrollSensitivitySetting) {
      //Down scroll
      ticking = true;
      if (currentSlideNumber !== totalSlideNumber - 1) {
        currentSlideNumber++;
        nextItem();
      }
      slideDurationTimeout(slideDurationSetting);
    }
    if (delta >= scrollSensitivitySetting) {
      //Up scroll
      ticking = true;
      if (currentSlideNumber !== 0) {
        currentSlideNumber--;
      }
      previousItem();
      slideDurationTimeout(slideDurationSetting);
    }
  }
}


function slideDurationTimeout(slideDuration) {
  setTimeout(function() {
    ticking = false;
  }, slideDuration);
}

// Event listeners
var mousewheelEvent = isFirefox ? "DOMMouseScroll" : "wheel";
window.addEventListener(mousewheelEvent, _.throttle(parallaxScroll, 60), false);

// Slide motion
function nextItem() {
  var $previousSlide = $(".background").eq(currentSlideNumber - 1);
  $previousSlide.removeClass("up-scroll").addClass("down-scroll");
}

function previousItem() {
  var $currentSlide = $(".background").eq(currentSlideNumber);
  $currentSlide.removeClass("down-scroll").addClass("up-scroll");
}
 
</script>

