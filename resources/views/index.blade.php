@extends('head')
<body class="landing-page">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5" href="../index.html">
        <img src="/argon/assets/img/brand/white.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
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
        
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="btn btn-neutral" href="{{ route('login') }}">
                            <span class="nav-link-inner--text">{{ __('Login') }}</span>
                        </a>
                    </li>
                @endif
                
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="btn btn-neutral" href="{{ route('register') }}">
                            <span class="nav-link-inner--text">{{ __('Register') }}</span>
                        </a>
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
  <div class="wrapper">
    <div class="section section-hero section-shaped">
      <div class="shape shape-style-3 shape-default">
        <span class="span-150"></span>
        <span class="span-50"></span>
        <span class="span-50"></span>
        <span class="span-75"></span>
        <span class="span-100"></span>
        <span class="span-75"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
      </div>
      <div class="page-header">
        <div class="container shape-container d-flex align-items-center py-lg">
          <div class="col px-0">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 text-center">
                <h1 class="text-white display-1">People stories</h1>
                <h2 class="display-4 font-weight-normal text-white">The time is right now!</h2>
                <div class="btn-wrapper mt-4">
                  <a href="https://www.creative-tim.com/product/argon-design-system" class="btn btn-warning btn-icon mt-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="ni ni-button-play"></i></span>
                    <span class="btn-inner--text">Play more</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div class="section features-6">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="info info-horizontal info-hover-primary">
              <div class="description pl-4">
                <h5 class="title">For Developers</h5>
                <p>The time is now for it to be okay to be great. People in this world shun people for being great. For being a bright color. For standing out. But the time is now.</p>
                <a href="#" class="text-info">Learn more</a>
              </div>
            </div>
            <div class="info info-horizontal info-hover-primary mt-5">
              <div class="description pl-4">
                <h5 class="title">For Designers</h5>
                <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at. That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                <a href="#" class="text-info">Learn more</a>
              </div>
            </div>
            <div class="info info-horizontal info-hover-primary mt-5">
              <div class="description pl-4">
                <h5 class="title">For Beginners</h5>
                <p>That’s what I do. That’s what I’m here for. Don’t be afraid to be wrong because you can’t learn anything from a compliment. If everything I did failed - which it doesn't.</p>
                <a href="#" class="text-info">Learn more</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-10 mx-md-auto">
            <img class="ml-lg-5" src="/argon/assets/img/ill/ill.png" width="100%">
          </div>
        </div>
      </div>
    </div>
    <div class="section features-1">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto text-center">
            <span class="badge badge-primary badge-pill mb-3">Insight</span>
            <h3 class="display-3">Full-Funnel Social Analytics</h3>
            <p class="lead">The time is now for it to be okay to be great. For being a bright color. For standing out.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
                <i class="ni ni-settings-gear-65"></i>
              </div>
              <h6 class="info-title text-uppercase text-primary">Social Conversations</h6>
              <p class="description opacity-8">We get insulted by others, lose trust for those others. We get back stabbed by friends. It becomes harder for us to give others a hand.</p>
              <a href="javascript:;" class="text-primary">More about us
                <i class="ni ni-bold-right text-primary"></i>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
                <i class="ni ni-atom"></i>
              </div>
              <h6 class="info-title text-uppercase text-success">Analyze Performance</h6>
              <p class="description opacity-8">Don't get your heart broken by people we love, even that we give them all we have. Then we lose family over time. As we live, our hearts turn colder.</p>
              <a href="javascript:;" class="text-primary">Learn about our products
                <i class="ni ni-bold-right text-primary"></i>
              </a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
                <i class="ni ni-world"></i>
              </div>
              <h6 class="info-title text-uppercase text-warning">Measure Conversions</h6>
              <p class="description opacity-8">What else could rust the heart more over time? Blackgold. The time is now for it to be okay to be great. or being a bright color. For standing out.</p>
              <a href="javascript:;" class="text-primary">Check our documentation
                <i class="ni ni-bold-right text-primary"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br /><br />
    
    @include('units.footer')
  </div>
  
 @include('units.scripts')
</body>

</html>