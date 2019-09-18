@extends('layouts.app')

@section('content')
@csrf
    <h1>Асуулт засах</h1>
    {!!Form::open(['action'=>['QuestionController@update',$question->id],'method'=>'post']) !!}
        <div class='form-group'>
            {{Form::label('name','Асуулт:')}}
            {{Form::text('question',$question->question,['class'=>'form-control', 'placeholder'=>'Асуулт'] )}}
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        </div>




    {!!Form::close()!!}
@endsection

