@extends('layouts.app')

@section('content')
{{-- @if (Auth::check()) --}}
    {{-- @if (Auth::user()->group_id==2) --}}
    
        <h1>ALL test here</h1>    
        @if (count($tests)>0)
        
        
        {{-- <button type="button" class="btn btn-primary" onclick="window.location.href = '/admin/test/create';">Шалгалт нэмэх</button> --}}
        {{--<a  href="/admin/test/create">Шалгалт нэмэх URL</a> --}}
        {{-- diffrent oclick to url --}}
        <a href="/admin/test/create" class="btn btn-primary">Шалгалт нэмэх</a>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Excel-ээс нэмэх</button>
        <button type="button" class="btn btn-success" ><?php ?></button>
        {{global_function_example('hello world')}}
        
{{--         
        <button class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i>Дахин дуудах</button>

        <button id="deleteList" class="btn btn-danger" style="display: none;" ><i class="glyphicon glyphicon-trash"></i>Жагсаалтаар устгах</button>

        <button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
 --}}
 <br><br>
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
                    <a href="/admin/test/create" class="btn btn-info">Дэлгэрэнгүй</a>
                    <a href="/admin/test/{{$test->id}}/edit" class="btn btn-warning">Засах</a>
                    {!!Form::open(['action'=>['TestController@destroy',$test->id],'method'=>'POST'])!!}    
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Усатгах',['class'=>'btn btn-danger','onclick'=>'return myFunction();'])}}
                    {!!Form::close()!!}
                    
                    {{-- <a href="/admin/test/create" class="btn btn-danger">Усатгах</a> --}}
                    {{-- <a class="btn btn-danger" onclick="return myFunction();" href="{{route('city-delete', $result->my_id)}}"><i class="fa fa-trash"></i></a> --}}



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
        {{-- <h1>{{$section = Test::find(1)->section->name}}</h1> --}}
        
        {{-- @else
            <p>No test Found</p>
        @endif --}}
    
     {{-- MODAL starts here  --}}
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Шалгалт нэмэх</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- {!! Form::open(['action' => 'TestController@store', 'method' => 'POST']) !!} --}}
            <div class="modal-body">
                   
                  
                    <label for="section">MODAL aas add failed !!! Must learn</label>
               
                    <label for="section">Хэсэг</label>
                    <select class="form-control" id="section">

                            @foreach ($sections as $section)
                            <option value='{{$section->id}}'>{{$section->name}}</option>
 
                        @endforeach
                    </select>
                    <label for="usr">Нэр:</label>
                    <input type="text" class="form-control" id="testname">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" action="TestController/store" method="Post">Save changes</button>
            </div>

          </div>
        </div>
      </div>
           
                    
                          
                    
            

     

    


    @else
        <h1>Permission denied</h1>
    @endif
@endsection

