@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            
            @include('developer.event.homeEvents')
        </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script>
 const url_eventPassed = @json(route('eventPassed'));
</script>
<script src="js/custom.js"></script>