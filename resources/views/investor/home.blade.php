{{-- @extends('layouts.inv')


@section('content')
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
@endsection --}}


@extends('layouts.inv')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged as investor!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      


{{-- call function event_passed globally --}}
<script>
 const url_eventPassed = @json(route('eventPassed'));
 const url_updStatusTrans = '/updStatus';
</script>
<script src="js/custom.js"></script>