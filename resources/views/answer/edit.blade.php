@extends('layouts.app')

@section('content')
@csrf
    <h1>Асуулт засах</h1>
    {!!Form::open(['action'=>['AnswerController@update',$answer->id],'method'=>'post']) !!}
        <div class='form-group'>
            <div class="form-group">
                <input type="hidden" id="question_id" name="question_id">
                <label for="answer">Хариулт</label>
                <input type="text" class="form-control" name="answer" id="answer" value="{{$answer->answer}}">
                @if ($answer->score==1)
                <input type="checkbox" name="correct" value="1" checked> Зөв хариулт мөн<br>        
                @else
                <input type="checkbox" name="correct" value="1"> Зөв хариулт мөн<br>        
                @endif
            
              </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        </div>

    {!!Form::close()!!}
@endsection

