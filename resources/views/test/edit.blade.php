@extends('layouts.app')

@section('content')
@csrf
    <h1>Шалгалт засах</h1>
    {!!Form::open(['action'=>['TestController@update',$test->id],'method'=>'post']) !!}
        <div class='form-group'>
            {{Form::label('name','Нэр:')}}
            {{Form::text('name',$test->name,['class'=>'form-control', 'placeholder'=>'name'] )}}
            {{Form::label('section','Хэсэг:')}}
            
            {!!section_select($test->section_id)!!}

            {{-- Select iig global function oos duudaj baigaa bolhoor bainga html bichih hereggui bolloo --}}
            {{-- <select name='section_id' placeholder='Хэсэг' class='form-control'>
                @foreach ($sections as $section)
                    @if ($section->id ==$test->section_id)
                        <option value='{{$section->id}}' selected>{{ $section ? $section->name : 'TEST' }}</option>
                    @else
                        <option value='{{$section->id}}'>{{$section->name}}</option>    
                    @endif
                    
               
                @endforeach
            </select> --}}
            {{-- {{Form::select('Хэсэг', $sections,['class'=>'form-control','placeholder'=>'Хэсэг'])}} --}}
            {{-- PUT request yavuulj baina --}}
            {{Form::hidden('_method','PUT')}}

            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        </div>




    {!!Form::close()!!}
@endsection

