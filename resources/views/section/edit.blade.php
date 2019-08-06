@extends('layouts.app')

@section('content')
@csrf
    <h1>Хэсэг засах</h1>
    {!!Form::open(['action'=>['SectionController@update',$section->id],'method'=>'post']) !!}
        <div class='form-group'>
            {{Form::label('name','Нэр:')}}
            {{Form::text('name',$section->name,['class'=>'form-control'], ['placeholder'=>'name'] )}}
                       
            {{Form::hidden('_method','PUT')}}
            <br>
            {{Form::submit('Засах',['class'=>'btn btn-primary'])}}
        </div>
    {!!Form::close()!!}
@endsection