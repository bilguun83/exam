 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

<script>  
  $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="answer[]" placeholder="Хариултаа оруулна уу" class="form-control name_list" /></td><td style="width:10px;"><button type="button" name="усатгах" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
           
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
  });  
  </script>
@extends('layouts.app')

@section('content')
@csrf
  <h1>Шалгалтын дэлгэрэнгүй</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
    Асуулт нэмэх
  </button>
    <br><br>
    <?php $pos=1; ?>
    @foreach ($test->question as $qlist)
      <div id="accordion{{$qlist->id}}">
        <div class="card">
          <div class="card-header" id="heading{{$qlist->id}}">
            <table class="table table-bordered">
              <tr>
                <th scope="row"  style="width:10px;"data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
                  {{$pos}}.&nbsp;
                </th>
                <td data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
                  {{$qlist->question ?: 'DB error!!!'}} 
                </td>
                <td style="width:25%;">
                  {!!Form::open(['action'=>['QuestionController@destroy',$qlist->id],'method'=>'POST'])!!} 
                  <button type="button" class="btn btn-success" data-toggle="modal" data-myid="{{$qlist->id}}"
                  data-target="#questionmodal">Нэмэх</button>
                  {{-- <a href="/question/answer/{{$qlist->id}}/" class="btn btn-info">Нэмэх</a> --}}
                  <a href="/question/{{$qlist->id}}/edit" class="btn btn-warning">Засах</a>  
                  {{-- <img src='{{ URL::to('/') }}/images/add.png' alt="Нэмэх" data-toggle="modal" data-target="#questionmodal">
                  <img src='{{ URL::to('/') }}/images/edit.png' alt="Засах"> --}}
                  {{Form::hidden('_method','DELETE')}}
                  {{Form::submit('Усатгах',['class'=>'btn btn-danger','onclick'=>'return myFunction();'])}}
                  {{-- <img src='{{ URL::to('/') }}/images/delete.png' alt="Усатгах" onclick="return myFunction();"> --}}
                  {!!Form::close()!!}
                  
                </td>
              </tr>
            </table>
          </div>
          <div id="collapse{{$qlist->id}}" class="collapse" aria-labelledby="heading{{$qlist->id}}" data-parent="#accordion{{$qlist->id}}">
            <div class="card-body">
              <?php $pos1=1; ?>
              @foreach ($qlist->answer as $alist)
                <table class="table table-bordered" data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
                  <tr>
                    <th scope="row"  style="width:10px;">
                      {{$pos1}}.&nbsp;
                    </th>
                    @if ($alist->score==1)
                      <td class="table-success">
                        {{$alist->answer}}
                      </td>        
                    @else
                      <td>
                        {{$alist->answer}} 
                      </td>    
                    @endif
                  </tr>
                </table>
                <?php $pos1++; ?>
              @endforeach
              
            </div>
          </div>
        </div>
      </div>
      <?php $pos++; ?>
    @endforeach 
    

      
      <!-- Modal  Asuult Hariult nemdeg-->
      <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myExtraLargeModalLabel">{{$test->name}} шалгалтын асуулт нэмэх</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action'=>'QuestionController@store','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
            {{csrf_field()}}
            <div class="modal-body">
                <input type="hidden" id="test_id" name="test_id" value="{{$test->id}}">
                <div class="form-group">
                  <h3> Асуулт:</h3>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                            <input type='text' class="form-control" name="newquestion">
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>

                  <table class="table table-bordered" id="dynamic_field"> 
                    <tr>
               
                      <th>Хариулт</th>
                      <th></th>
                    </tr> 
                    <tr>  
                        <td>
                          <input type="text" name="answer[]" placeholder="Зөв хариултаа оруулна уу" class="form-control name_list" /></td>  
                         <td style="width:10px;"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>  
                         
                    </tr>  
               </table>  
                </div>
            
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      
      <!-- Question Modal -->
<div class="modal fade" id="questionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Хариулт нэмэх</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['action'=>'AnswerController@store','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
        {{csrf_field()}}
        
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="question_id" name="question_id">
            <label for="answer">Хариулт</label>
            <input type="text" class="form-control" name="answer" id="answer">
            <input type="checkbox" name="correct" value="1"> Зөв хариулт мөн<br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {{Form::close()}}
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
        $('#questionmodal').on('show.bs.modal', function (event) {
          console.log("modal opened")
          var button = $(event.relatedTarget) 
          var answer = button.data('myid') 
          var modal = $(this)
          modal.find('.modal-body #question_id').val(answer)
          
        })
 </script>
@endsection

