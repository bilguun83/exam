@extends('layouts.app')

@section('content')
@csrf
<br>
        @if (count($stests)>0)
          {{$stests->links()}} 
          
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead class='thead-danger'>
                    <tr>
                        <th>Овог нэр</th>
                        <th>Шалгалтын төрөл</th>
                        <th>Шалгалтын нэр</th>
                        <th>Оноо</th>
                        <th>Эхэлсэн</th>
                        <th>Дууссан</th>
                        <th style="width:200px;">Үйлдэл</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($stests as $stest)
                <tr>

                    <td>
                    {{-- <a href='/admin/section/{{$section->id}}'>{{$section->name}}</a> --}}
                        {{display_userinfo($stest->user_id)}}
                    </td>
                    <td>
                        {{display_group($stest->section_id)}}
                    </td>
                    <td>
                        {{$stest->name}}
                    </td>

                    <td>
                        {{($stest->score*100)/$stest->total}}% ({{$stest->score}}/{{$stest->total}})
                    </td><td>
                        {{$stest->created_at}}
                    </td>
                    <td>
                        {{$stest->updated_at}}
                    </td>

                    <td>
  
                        <button type="button" class="btn btn-success" data-toggle="modal" data-myid="{{$stest->id}}"
                                data-target="#requestmodal">Print</button>
                    </td>
                </tr>
            @endforeach
            
            </tbody>

            <tfoot>
                    <tr>
                            <th>Овог нэр</th>
                            <th>Шалгалтын төрөл</th>
                            <th>Шалгалтын нэр</th>
                            <th>Оноо</th>
                            <th>Эхэлсэн</th>
                            <th>Дууссан</th>
                            <th style="width:200px;">Үйлдэл</th>
                        </tr>

            </tfoot>
        </table>
          
        {{$stests->links()}}

    @else
        <h1>Дууссан шалгалт алга</h1>
    @endif

    <div class="modal fade" id="requestmodal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestModalLabel">Print songolt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        {!! Form::open(['action'=>'ExamController@print','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        {{csrf_field()}}
        <div class="modal-body">
        <input type="hidden" id="stest_id" name="stest_id">
        {{-- END COMBOBOX --}}
        <select name='choice' class='form-control'>
                <option value='1'>Холбоо</option>
                <option value='2'>Навигаци</option>
                <option value='3'>Ажиглалт</option>
                <option value='4'>Цахилгаан</option>
                <option value='5'>Дүрмийн</option>
        </select>
         </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </div>
    </div>
  </div>

    <script>
        $('#requestmodal').on('show.bs.modal', function (event) {
          console.log("modal opened")
          var button = $(event.relatedTarget) 
          var answer = button.data('myid') 
          var modal = $(this)
          modal.find('.modal-body #stest_id').val(answer)
          
        })
 </script>
@endsection

