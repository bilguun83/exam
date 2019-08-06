@extends('layouts.app')

@section('content')
@csrf
    <h1>Шалгуулагчийн мэдээлэл засах</h1>
    {!!Form::open(['action'=>['StudentController@update',$student->id],'method'=>'post']) !!}

        <div class="form-group row">
            <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Овог') }}</label>

            <div class="col-md-6">
                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{$student->lname}}" required autocomplete="lname" autofocus>
                    @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

            <div class="col-md-6">
                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{$student->fname}}" required autocomplete="fname" autofocus>

                @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        

             
        <div class="form-group row">
            <label for="school" class="col-md-4 col-form-label text-md-right">{{ __('Төгссөн сургууль, курс, он') }}</label>

            <div class="col-md-6">
                <input id="school" type="text" class="form-control @error('school') is-invalid @enderror" name="school" value="{{$student->school}}" required autocomplete="school" autofocus>

                @error('school')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="field" class="col-md-4 col-form-label text-md-right">{{ __('Мэргэжил') }}</label>

            <div class="col-md-6">
                <input id="field" type="text" class="form-control @error('field') is-invalid @enderror" name="field" value="{{$student->field}}" required autocomplete="field" autofocus>

                @error('field')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="degree" class="col-md-4 col-form-label text-md-right">{{ __('Мэргэшлийн зэрэг') }}</label>

            <div class="col-md-6">
                <input id="degree" type="text" class="form-control @error('degree') is-invalid @enderror" name="degree" value="{{$student->degree}}" required autocomplete="degree" autofocus>

                @error('degree')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Албан тушаал') }}</label>

            <div class="col-md-6">
                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{$student->position}}" required autocomplete="degree" autofocus>

                @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$student->email}}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                
            </div>
        </div>

        <div class="form-group row">
            <label for="group" class="col-md-4 col-form-label text-md-right">Эрх</label>

            <div class="col-md-6">
                <select name='group'>
                    <option value="1">Шалгуулагч</option>
                    <option value="2">Багш</option>
                </select>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Засах
                </button>
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        <br>
        {{Form::submit('Засах',['class'=>'btn btn-primary'])}}
@endsection