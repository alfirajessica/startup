@extends('layouts.dev')
<style>
    .scroll {
    max-height: 380px;
    overflow-y: auto;
  }
  </style>
@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row py-2">
        @foreach ($header_events as $item)
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-body px-0" style="background-color: #EFEFEF">
                    <div class="row">
                        <div class="col-md-7">
                            <h4 class="card-title font-weight-bold" name="name_project" id="name_project">{{$item->name}}</h4>
                        </div>
                        <div class="col-md-5">
                            <button type="button" class="btn btn-default float-right btn-block" id="pay-button" onclick="joinEvent()">GABUNG EVENT</button> 
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-md-7  mb-0">

                            <input type="hidden" name="id_event" value={{$item->id}}>
                    
                            
                            <img id="previewImg2" class="d-block user-select-none shadow" style="width: 100%; max-height:380px;" src="/uploads/event/{{$item->image}}" >
                        </div>


                        <div class="col-md-5 py-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow scroll">
                                        <div class="card-body">
                                            <h5>Informasi Event</h5>
                                            
                                            <strong id="held_detailEvent" class="d-inline-block mb-2 text-success">{{$item->held}}</strong>
                                            <h6 id="row_link" class="d-none"> <a href="{{$item->link}}">  {{$item->link}} </a> </h6>
                                            <h6 id="row_loc" class="d-none"><i class="fas fa-map-marker-alt"></i>  {{$item->province_name}}, {{$item->city_name}}, 
                                                {{$item->address}}</h6>
                                            <h6><i class="fas fa-calendar-alt"></i>  {{ \Carbon\Carbon::parse($item->event_schedule)->format('d/M/Y')}} </h6>
                                            <h6><i class="fas fa-clock"></i>  {{ \Carbon\Carbon::parse($item->event_time)->format('h:s')}}  </h6>
                                            <p class="card-text">{{$item->desc}}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="/js/dev/detailsEvent.js"></script>
@endsection




