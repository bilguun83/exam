@if (Auth::user()->status==NULL or Auth::user()->status==1)
    
    <a href="request/{{Auth::user()->id}}" class="btn btn-info">Шалгалт өгөх хүсэлт гаргах</a>
@else
    Busad STATUS is here
@endif
