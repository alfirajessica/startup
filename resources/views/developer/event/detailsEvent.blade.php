@extends('layouts.dev')

@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row py-4">
        {{-- <form action="{{ route('dev.event.joinEvent')}}" method="post" id="joinEvent">
            @csrf --}}
                @foreach ($header_events as $item)
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body px-0" style="background-color: #f7f3e9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title font-weight-bold" name="name_project" id="name_project">{{$item->name}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8  mb-0">

                                    {{-- @if (session('status'))
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
                                    @endif --}}

                                    <input type="hidden" name="id_event" value={{$item->id}}>
                            
                                    
                                    <img id="previewImg2" class="d-block user-select-none shadow" width="100%" max-height="500" src="/uploads/event/{{$item->image}}" >
                                </div>


                                <div class="col-md-4 ">
                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" id="pay-button" onclick="joinEvent()">GABUNG EVENT</button> 

                                            {{-- <button type="submit" class="btn btn-primary btn-lg btn-block">GABUNG EVENT</button> --}}
                                        </div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-md-12">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <h5>Event Info</h5>
                                                    <br>
                                                    <strong id="held_detailEvent" class="d-inline-block mb-2 text-success">{{$item->held}}</strong>
                                                    <h6 id="row_link" class="d-none"><i class="fas fa-external-link-alt"></i> <a href="{{$item->link}}"> {{$item->link}} </a> </h6>
                                                    <h6 id="row_loc" class="d-none"><i class="fas fa-map-marker-alt"></i> {{$item->province_name}}, {{$item->city_name}} </h6>
                                                    <h6><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->event_schedule)->format('d/M/Y')}} </h6>
                                                    <h6><i class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($item->event_time)->format('h:m')}}  </h6>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <div class="row py-4">
                                <div class="col-md-8">
                                    <div class="card shadow border-0">
                                        <div class="card-body">
                                            <p class="card-text">{{$item->desc}}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        {{-- </form>  --}}
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      



<script src="/js/dev/detailsEvent.js">
    
</script>

