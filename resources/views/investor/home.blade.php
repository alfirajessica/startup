
@extends('layouts.inv')


@section('content')
    <div class="main-wrapper-onepage main oh" style="overflow-y: hidden">
        <!-- Text Rotator -->
        <section class="hero-wrap text-center" style="background-image: url(/images/person-using-tablet.jpg); opacity: 0.5;">

            <div class="container container-full-height">
            <div class="hero-holder">
                <div class="hero-message text-rotator">
                <h1><span class="rotate" style="color:black;"> Amazing Template</span></h1>
                <h2 class="hero-subtitle hidden-xs">Enigma is a Creative Minimal Style Onepage. It is Fully Responsive and Retina Ready. Grab This Awesome Template Now.</h2>
                <div class="buttons-holder mt-30">
                    <a href="#" class="btn btn-lg btn-transparent">Learn More</a>
                    <a href="#" class="btn btn-lg btn-white">Purchase it</a>
                </div>
                <div class="local-scroll">
                    <a href="#intro" class="scroll-down">
                    <i class="fa fa-angle-down"></i>
                    </a>
                </div>
                </div>
            </div>
            </div>
  
      </section> <!-- end text rotator -->

      <!-- Intro -->
        <section class="section-wrap intro" id="intro" >
            <div class="container container-full-height">
            <div class="row">
    
                <div class="col-sm-8 col-sm-offset-2 text-center wow slideInUp" data-wow-duration="1.2s" data-wow-delay="0s" style="visibility: visible; animation-duration: 1.2s; animation-delay: 0s; animation-name: slideInUp;">
                <h2 class="intro-heading heading-frame">Welcome to Enigma</h2>
                <p class="intro-text mb-60">
                    We continuosly seek between design and technology. For over a decade, we've helped businesses to craft honest, emotional experiences through strategy, brand development, graphic design, web design. Our team hand picked to provide the right balance of skills to work.
                </p>
    
                <img src="img/intro_logo.png" alt="">
                </div>
                
            </div>
            <div class="local-scroll">
                <a href="#services" class="scroll-down">
                <i class="fa fa-angle-down"></i>
                </a>
            </div>
            </div>
      </section> <!-- end intro -->

      <section class="section-wrap bg-light pb-mdm-50 pb-130" id="services">
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
      </section>
    </div>

    
    {{-- @include('units.jumbotron')
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
                <img class="ml-lg-5" src="/images/Product tour-cuate.png" width="100%">
            </div>
            </div>
        </div>
    </div> --}}

    
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      


{{-- call function event_passed globally --}}
<script>
 const url_eventPassed = @json(route('eventPassed'));
 const url_updStatusTrans = @json(route('updStatus'));
 
</script>
<script src="js/custom.js"></script>