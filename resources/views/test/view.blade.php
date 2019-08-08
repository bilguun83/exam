@extends('layouts.app')

@section('content')
@csrf
    <h1>Шалгалтын дэлгэрэнгүй</h1>
   
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
    
     
    {{-- @foreach ($test->answer as $answer)
        {{$answer->question->question}}     
        {{$answer->answer}}<br>
    @endforeach --}}
@endsection

