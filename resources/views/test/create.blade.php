@extends('layouts.app')

@section('content')
    <h1>Шалгалт нэмэх</h1>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        {{Form::label('name','Нэр:')}}
        {{Form::text('name','',['class'=>'form-control'], ['placeholder'=>'name'])}}
        {{Form::label('section','Хэсэг:')}}
        
        {!!section_select(1)!!}
        <br>
        {{Form::label('Questions','Асуултууд:')}}
        
        @csrf

        <input type="file" name="file"/>
        <br><br>
        <button class="btn btn-success">Import User Data</button>
    </form>
   
        

@endsection

