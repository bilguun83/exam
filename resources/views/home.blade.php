@extends('layouts.app')

@section('content')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (Auth::user()->group_id==1)

                        @include('user.index')
                    @else
                        teacher home
                    
                    @endif  

@endsection
