@extends('layouts.app')

@section('content')
@csrf
<br>  
        
        

        <a href="/admin/test/create" class="btn btn-primary">Шалгалт нэмэх</a>
        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Modal-ээс нэмэх</button> --}}
  <br><br>
  @if (count($tests)>0)
        {{$tests->links()}}
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Нэр</th>
                        <th>Шалгалт үүссэн огноо</th>
                        <th>Шалгалт update огноо</th>
                        <th>Status</th>
                        <th>Section_id</th>
                        <th style="width:200px;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($tests as $test)
                <tr>

                    <td>
                    <a href='/admin/test/{{$test->id}}'>{{$test->name}}</a>
                    </td>
                    <td>
                        {{$test->created_at}}
                    </td>
                    <td>
                        {{$test->updated_at}}
                    </td>
                    <td>
                        {{$test->status}}
                    </td>
                    <td>
                            
                        {{App\Section::find($test->section_id)->name}}
                    </td>
                    <td>
                   
                    {!!Form::open(['action'=>['TestController@destroy',$test->id],'method'=>'POST'])!!} 
                    <a href="/admin/test/{{$test->id}}/view" class="btn btn-info">Дэлгэрэнгүй</a>
                    <a href="/admin/test/{{$test->id}}/edit" class="btn btn-warning">Засах</a>   
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
                        <th>Status</th>
                        <th>Section_id</th>
                        <th style="width:200px;">Үйлдэл</th>
                </tr>
            </tfoot>
        </table>
        {{$tests->links()}}
 
              
     @else
        <h1>Шалгалт байхгүй</h1>
    @endif
@endsection

