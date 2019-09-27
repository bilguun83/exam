@extends('layouts.app')

@section('content')
@csrf
<br>
        @if (count($sections)>0)
        <a href="/admin/section/create" class="btn btn-primary">Хэсэг нэмэх</a>
         <br><br>
        
         {{$sections->links()}} 
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Нэр</th>
                        <th>Шалгалт үүссэн огноо</th>
                        <th>Шалгалт update огноо</th>
                        <th style="width:200px;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($sections as $section)
                <tr>

                    <td>
                    {{-- <a href='/admin/section/{{$section->id}}'>{{$section->name}}</a> --}}
                        {{$section->name}}
                    </td>
                    <td>
                        {{$section->created_at}}
                    </td>
                    <td>
                        {{$section->updated_at}}
                    </td>
                  
                    <td>
                        
                        {!!Form::open(['action'=>['SectionController@destroy',$section->id],'method'=>'POST'])!!}    
                        <a href="/admin/section/{{$section->id}}/edit" class="btn btn-warning">Засах</a>
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

                        <th>Нэр</th>
                        <th>Шалгалт үүссэн огноо</th>
                        <th>Шалгалт update огноо</th>
                        <th style="width:200px;">Үйлдэл</th>
                </tr>
            </tfoot>
        </table>
        {{$sections->links()}}

    @else
        <h1>Хэсэг алга</h1>
        <a href="/admin/section/create" class="btn btn-primary">Хэсэг нэмэх</a>
    @endif
@endsection

