@extends('layouts.app')

@section('content')
{{-- @if (Auth::check()) --}}
    {{-- @if (Auth::user()->group_id==2) --}}
        <h1>ALL test here</h1>    
        @if (count($tests)>=1)
{{--         
        <button class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i>Дахин дуудах</button>

        <button id="deleteList" class="btn btn-danger" style="display: none;" ><i class="glyphicon glyphicon-trash"></i>Жагсаалтаар устгах</button>

        <button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
 --}}
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
                        {{$test->name}}
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
                        {{$test->section_id}}
                    </td>
                    <td>
                        <button class='btn btn-success'>EDIT</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
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
        {{-- @else
            <p>No test Found</p>
        @endif --}}
    
      
        
           
                    
                          
                    
            

     

    


    @else
        <h1>Permission denied</h1>
    @endif
@endsection

