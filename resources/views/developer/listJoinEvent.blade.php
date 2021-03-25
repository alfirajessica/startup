@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
        @foreach ($myevents as $item)
            <label for="">{{$item->name}}</label>
        @endforeach
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
$(document).ready(function () {

});
</script>
