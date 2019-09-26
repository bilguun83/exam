@extends('layouts.app')

@section('content')


     {!!display_print($user->id,$stest->id,$choice)!!}

    


{{--     
    {{$user->fname}}
    <br>
    {{$stest->name}}
    <br>
    {{$choice}} --}}
@endsection