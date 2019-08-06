@extends('layouts.app')

@section('content')
@csrf
    <a href="/admin/test/" class="btn btn-default">Буцах</a>
    <h1>{{$test->name}} шалгалтын асуултууд</h1>
@endsection
