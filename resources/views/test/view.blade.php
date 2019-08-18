 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

<script>  
  $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td style="width:10px;"><input type="radio" name="correct" value="'+i+'"></td><td><input type="text" name="answer[]" placeholder="Асуултаа оруулна уу" class="form-control name_list" /></td><td style="width:10px;"><button type="button" name="усатгах" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
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
                <td style="width:15px;"><button type="button" name="answeradd" id="answeradd" class="btn btn-success" data-toggle="modal" data-target="#questionmodal">+</button></td>  
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
    

      
      <!-- Modal -->
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
                      <th></th>
                      <th>Хариулт</th>
                      <th></th>
                    </tr> 
                    <tr>  
                      <td style="width:10px;"><input type="radio" name="correct" value="1"></td>                        
                      <td>
                          <input type="text" name="answer[]" placeholder="Хариултаа оруулна уу" class="form-control name_list" /></td>  
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
@endsection

