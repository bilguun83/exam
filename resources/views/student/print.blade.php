@extends('layouts.app')

@section('content')

<div style="margin-left: 50px;">
     {!!display_print($user->id,$stest->id,$choice)!!}
</div>

    


{{--     
    {{$user->fname}}
    <br>
    {{$stest->name}}
    <br>
    {{$choice}} --}}
@endsection