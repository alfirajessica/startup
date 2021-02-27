@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
        <div class="row"> <!-- row -->
            @include('units.jumbotron')
            @include('developer.event.homeEvents')
        </div>
</div>
@endsection
