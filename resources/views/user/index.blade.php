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
        <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
        @break

    @case(1)
    <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
        @break
    @case(2)
        Soril uusegej baina
        @break
    @case(3)
        Soril ehelsen
        @include('user.test')
        @break
    @default
        Default case...
@endswitch

