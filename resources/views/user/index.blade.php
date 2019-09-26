{{-- @if (Auth::user()->status==NULL or Auth::user()->status==1)
    
    <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
@else
    @if (Auth::user()->status==2)
        Soril huleej baina
    @else
    Busad STATUS is here        
    @endif    

@endif --}}
@switch(Auth::user()->status)
    @case(NULL)
    {{-- new user --}}
        <br>
        <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
        @break

    @case(1)
    <br>
    {{-- test ugsun user --}}
    <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
        @break
    @case(2)
        {{-- Soril uusegej baina tur huleene uu. --}}
        @break
    @case(3)
{{-- test ugch baigaa user --}}
        @include('user.test')
        <a href="request1/{{Auth::user()->id}}" class="btn btn-info">Дуусгах</a>
        @break
    @case(4)
    {{-- shalgatliin onootoi taniltsaj baigaa user --}}
    
        @include('user.result')
        <a href="request2/{{Auth::user()->id}}" class="btn btn-info">Шалгалтын оноотой танилцав</a>
        @break
           @break
    @default
        Default case...
@endswitch

