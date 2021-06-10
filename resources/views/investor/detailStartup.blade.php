@extends('layouts.inv')

@section('content')
<div class="container">
    <div class="row">
        <nav>
            <ol class="breadcrumb fixed-top" style="top:60px;justify-content: center;">
                <li class="breadcrumb-item active"><a href="#produk">Produk</a></li>
                <li class="breadcrumb-item"><a href="#tentang_produk">Tentang Produk</a></li>
                <li class="breadcrumb-item"><a href="#financial">Keuangan</a></li>
                <li class="breadcrumb-item"><a href="#review">Review</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">

    <div class="row" >
        <div class="py-4"></div>
            <div class="col-md-12">
                
                @foreach ($list_project as $item)
                    {{-- image, desc site info, about product --}}
                    @include('investor.detailStartup.desc') 
                @endforeach
            </div>        
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
