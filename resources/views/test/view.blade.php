@extends('layouts.app')

@section('content')
@csrf
  <h1>Шалгалтын дэлгэрэнгүй</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Асуулт нэмэх
  </button>
    <br><br>
    {{-- <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            sdfdas
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              HARIULTUUD HERE
            </div>
          </div>
        </div>
    </div> --}}
    <?php $pos=1; ?>
    @foreach ($test->question as $qlist)
      <div id="accordion{{$qlist->id}}">
        <div class="card">
          <div class="card-header" id="heading{{$qlist->id}}">
            <table class="table table-bordered" data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
              <tr>
                <th scope="row"  style="width:10px;">
                  {{$pos}}.&nbsp;
                </th>
                <td>
                  {{$qlist->question}} 
                </td>
                <td>
                  {{$qlist->level}} 
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
                    <td>
                      {{$alist->answer}} 
                    </td>
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
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$test->name}} шалгалтын асуулт нэмэх</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['action'=>'QuestionController@store','method'=>'POST', 'enctype'=>'multipart/form-data'])!!}
            <div class="modal-body">
                <input type="hidden" id="test_id" name="test_id" value="{{$test->id}}">
                <div class="form-group">
                  <table class="table">
                    <thead>
                      <tr>
                      <th>Асуулт </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                            <textarea class="form-control" name="newquestion">
                            </textarea>
                        </td>
                      </tr>
                    </tbody>
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
@endsection

