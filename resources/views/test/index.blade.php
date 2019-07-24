@extends('layouts.app')

@section('content')
{{-- @if (Auth::check()) --}}
    {{-- @if (Auth::user()->group_id==2) --}}
        <h1>ALL test here</h1>    
        @if (count($tests)>=1)
        <button type="button" class="btn btn-primary"data-toggle="modal" data-target="#exampleModal">Шалгалт нэмэх</button>
        <button type="button" class="btn btn-success">Excel-ээс нэмэх</button>
        
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
                        <button class='btn btn-warning'>Засах</button>
                        <button type="button" class="btn btn-danger">Усатгах</button>
                        <button type="button" class="btn btn-info">Дэлгэрэнгүй</button>
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
    
     {{-- MODAL starts here  --}}
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
           
                    
                          
                    
            

     

    


    @else
        <h1>Permission denied</h1>
    @endif
@endsection

