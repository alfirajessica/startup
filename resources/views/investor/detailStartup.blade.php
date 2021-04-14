@extends('layouts.inv')

@section('content')
<div class="container">
     <!-- card shadow -->
    <div class="row py-4"> <!-- row -->
        {{-- @include('units.jumbotron') --}}
        <div class="py-4"></div>
    </div>
    <div class="row py-4">
        <div class="py-4"></div>
        <div class="col-md-4 mb-0"><!--col-md-4 -->
            <button type="button" class="btn btn-primary btn-lg btn-block">Investasikan</button>
            <hr>
            @include('investor.detailStartup.profilStartup')
        </div><!--end col-md-4 -->
        
        <div class="col-md-8"> <!--col-md-8 -->
            @foreach ($list_project as $item)
                {{-- image, desc site info, about product --}}
                @include('investor.detailStartup.desc') 
            @endforeach
                {{-- tabel keuangan --}}
            
            
                @include('investor.detailStartup.financial')
            

                {{-- rating, ulasan --}}
                @include('investor.detailStartup.ulasan')
           
        </div><!--end col-md-8 -->
    </div>
</div>

<script>
//----------------stars rating ----------------------------------//
        //initial setup
        document.addEventListener('DOMContentLoaded', function(){
            let stars = document.querySelectorAll('.star');
            stars.forEach(function(star){
                star.addEventListener('click', setRating); 
            });
            
            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
            let target = stars[rating - 1];
            //target.dispatchEvent(new MouseEvent('click'));
        });

        function setRating(ev){
            let span = ev.currentTarget;
            let stars = document.querySelectorAll('.star');
            let match = false;
            let num = 0;
            stars.forEach(function(star, index){
                if(match){
                    star.classList.remove('rated');
                }else{
                    star.classList.add('rated');
                }
                //are we currently looking at the span that was clicked
                if(star === span){
                    match = true;
                    num = index + 1;
                }
            });
            document.querySelector('.stars').setAttribute('data-rating', num);
        }
        //----------------end of stars rating ----------------------------------//
</script>

@endsection
