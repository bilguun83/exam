@extends('layouts.app')

@section('content')
@csrf
<br>
        @if (count($students)>0)
          {{$students->links()}} 
          
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead class='thead-danger'>
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
                        {{display_group($student->group_id)}}
                    </td>
                    <td>
                        @if ($student->status==2)
                        <button type="button" class="btn btn-success" data-toggle="modal" data-myid="{{$student->id}}"
                                data-target="#requestmodal">Cорил +</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-myid="{{$student->id}}"
                                        data-target="#requestmodal">Cорил 1</button>
                        @else
                        <button type="button" class="btn btn-danger">Сорил дуусгах</button>
                        @endif

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


         <!-- Question Modal asuultad hariult nemdeg modal -->
<div class="modal fade" id="requestmodal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestModalLabel">Сорил үүсгэх</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- {!!Form::open(['action'=>['TestController@destroy',$test->id],'method'=>'POST'])!!}  --}}
        {!! Form::open(['action'=>'ExamController@makeExam','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        {{csrf_field()}}
        <div class="modal-body">
        <input type="hidden" id="user_id" name="user_id">
        {!!alltest()!!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Үүсгэх</button>
        </div>

      </div>
    </div>
  </div>
  <script>
    function myFunction() {
        if(!confirm("Are You Sure to delete this"))
        event.preventDefault();
    }
</script>
    <script>
        $('#requestmodal').on('show.bs.modal', function (event) {
          console.log("modal opened")
          var button = $(event.relatedTarget) 
          var answer = button.data('myid') 
          var modal = $(this)
          modal.find('.modal-body #user_id').val(answer)
          
        })
 </script>
@endsection

