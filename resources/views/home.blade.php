@guest
    @include('index')
    @else 
        @if (Auth::user()->role ==1 )
            @include('layouts.dev')

        @elseif(Auth::user()->role ==2)
            @include('layouts.inv')
        @endif     
@endguest