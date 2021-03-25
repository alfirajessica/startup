@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row py-4"> <!-- row -->
        {{-- @include('units.jumbotron') --}}
    </div>
    <div class="row py-4">
        <div class="py-4"></div>
        <div class="col-md-4 mb-0"><!--col-md-4 -->
            
            <hr>
            <div class="card profile-card-3">
                <div class="background-block">
                    <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background"/>
                </div>
                <div class="profile-thumb-block">
                    <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                </div>
                <div class="card-content">
                <h2>Justin Mccoy<small>Designer</small></h3>
                <div class="icon-block"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"> <i class="fa fa-twitter"></i></a><a href="#"> <i class="fa fa-google-plus"></i></a></div>
                </div>
            </div>   
        </div><!--end col-md-4 -->
        
        <div class="col-md-8"> <!--col-md-8 -->
            <form action="{{ route('dev.event.joinEvent')}}" method="post" id="joinEvent">
            @csrf

            @if (session('status'))
                <script>
                    $(document).ready(function () {
                        swal("{{ session('status') }}", "You clicked the button!", "success");
                    });
                </script>
            @endif
            @if (session('fail'))
                <script>
                    $(document).ready(function () {
                        swal("{{ session('fail') }}", "You clicked the button!", "warning");
                    });
                </script>
            @endif
            

            @foreach ($header_events as $item)
            
            <input type="text" name="id_event" value={{$item->id}}>
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                </div>
                <img id="previewImg2" class="d-block user-select-none" width="100%" height="400" src="/uploads/event/{{$item->image}}" >
                </a>
                <div class="card-body">
                <p class="card-text">{{$item->desc}}</p>
                </div>
            </div>

            <div class="card border-0 py-4">
                <div class="card-body shadow">
                    <h5>Event Info</h5>
                    <br>
                    <strong id="held_detailEvent" class="d-inline-block mb-2 text-success">{{$item->held}}</strong>
                    <h6 id="row_link" class="d-none"><i class="fas fa-external-link-alt"></i> <a href="{{$item->link}}"> {{$item->link}} </a> </h6>
                    <h6 id="row_loc" class="d-none"><i class="fas fa-map-marker-alt"></i> {{$item->province_name}}, {{$item->city_name}} </h6>
                    <h6><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->event_schedule)->format('d/M/Y')}} </h6>
                    <h6><i class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($item->event_time)->format('h:m')}}  </h6>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary float-right">JOIN</button>
                {{-- <a  href="{{ route('dev.event.joinEvent', ['id' =>$item->id]) }}" class="btn btn-primary" id="joinEvent" onclick="coba()">Detail Event</a> --}}
            </div>    
            </form> 
        </div><!--end col-md-8 -->
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {
        held_detailEvent();
        
    });

    function held_detailEvent() {
        var event_held = $("#held_detailEvent").text(); 
    
        if (event_held == "Online") {
            document.querySelector('#row_link').classList.remove('d-none');
            document.querySelector('#row_loc').classList.add('d-none');
            
        }
        else if (event_held == "Offline") {
            document.querySelector('#row_link').classList.add('d-none');
            document.querySelector('#row_loc').classList.remove('d-none');
        }
    }
    
    $("#joinEvent").on("submit",function (e) {
        e.preventDefault();
   
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function() {
                $(document).find('span.error-text').text('');
            },
            success:function(data) {
                if (data.status == -1) {
                    $.each(data.error, function (prefix, val) {
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else{
                    
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                
                }
            }
        });
    });
</script>

