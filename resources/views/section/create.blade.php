@extends('layouts.app')

@section('content')
@csrf
    <h1>Хэсэг нэмэх</h1>
        {!! Form::open(['action'=>'SectionController@store','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        
        {{Form::label('name','Нэр:')}}
        {{Form::text('name','',['class'=>'form-control'], ['placeholder'=>'name'])}}
        <br><br>
        <button class="btn btn-success">Оруулах</button>
    </form>
   
        

@endsection

