@extends('layouts.app')

@section('content')
    <h1>Шалгалт нэмэх</h1>
    {!!Form::open(['action'=>'TestController@store'],['method'=>'post']) !!}
        <div class='form-group'>
            {{Form::label('name','Нэр:')}}
            {{Form::text('name','',['class'=>'form-control'], ['placeholder'=>'name'] )}}
            {{Form::label('section','Хэсэг:')}}
            
            <select name='section_id' placeholder='Хэсэг' class='form-control'>
                @foreach ($sections as $section)
                    <option value='{{$section->id}}'>{{$section->name}}</option>
               
                @endforeach
            </select>
            {{-- {{Form::select('Хэсэг', $sections,['class'=>'form-control','placeholder'=>'Хэсэг'])}} --}}
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        </div>




    {!!Form::close()!!}
@endsection

