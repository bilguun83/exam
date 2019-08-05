@extends('layouts.app')

@section('content')
<br>
        @if (count($students)>0)
          {{$students->links()}} 
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Овог</th>
                        <th>Нэр</th>
                        <th>Төгссөн сургууль, курс, он</th>
                        <th>Мэргэжил</th>
                        <th>Мэргэшлийн зэрэг    </th>
                        <th>Албан тушаал</th>
                        <th>E-Mail Address</th>
                        <th>Group</th>
                        <th style="width:200px;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($students as $student)
                <tr>

                    <td>
                    {{-- <a href='/admin/section/{{$section->id}}'>{{$section->name}}</a> --}}
                        {{$student->lname}}
                    </td>
                    <td>
                        {{$student->fname}}
                    </td>
                    <td>
                        {{$student->school}}
                    </td>

                    <td>
                        {{$student->field}}
                    </td>
                    <td>
                        {{$student->degree}}
                    </td><td>
                        {{$student->position}}
                    </td>
                    <td>
                        {{$student->email}}
                    </td>
                    <td>
                        {{$student->group_id}}
                    </td>
                    <td>
                        <a href="/admin/student/{{$student->id}}/edit" class="btn btn-warning">Засах</a>
                        {!!Form::open(['action'=>['StudentController@destroy',$student->id],'method'=>'POST'])!!}    
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Усатгах',['class'=>'btn btn-danger','onclick'=>'return myFunction();'])}}
                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
            
            </tbody>
            <script>
                    function myFunction() {
                        if(!confirm("Are You Sure to delete this"))
                        event.preventDefault();
                    }
                   </script>
            <tfoot>
                <tr>

                    <th>Овог</th>
                    <th>Нэр</th>
                    <th>Төгссөн сургууль, курс, он</th>
                    <th>Мэргэжил</th>
                    <th>Мэргэшлийн зэрэг    </th>
                    <th>Албан тушаал</th>
                    <th>E-Mail Address</th>
                    <th>Group</th>
                    <th style="width:200px;">Үйлдэл</th>
                </tr>
            </tfoot>
        </table>
        {{$students->links()}}

    @else
        <h1>User table empty and why are you here!!!</h1>
    @endif
@endsection

