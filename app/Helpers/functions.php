<?php
use App\Section;
use App\Test;
use App\Stest;
use App\Squesiton;
use App\Sanswer;


function global_function_example($str)
{
   return 'A Global Function with '. $str;
}

function section_select($id){

   $sections = Section::all();
   $data = "<select name='section_id' placeholder='Хэсэг' class='form-control'>";
   
   foreach ($sections as $section){
       if ($section->id ==$id)
           $data.="<option value='".$section->id."' selected>".$section->name."</option>";   
       else
       $data.="<option value='".$section->id."'>".$section->name."</option>";     
       
             }
   $data.="</select>";
   return $data;          
}
function display_group($id){
    $section = Section::find($id);
    return $section->name;
}
function alltest(){

   $tests = Test::all();
   $data = "
   <input type='text' name='test_name' class='form-control'><br>";
   $data.=section_select(1);
   $data.="<table id='table' class='table table-striped table-bordered' cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th >Нэр</th>
                        <th style='width:10px;'>Max</th>
                        <th style='width:50px;'>Тоо</th>
                    </tr>
                </thead>
                <tbody>";
         
                foreach ($tests as $test){
                $data.="<tr>
                   <td>
                     <a href='/admin/test/$test->id/view' target='_blank' tabindex='-1'>$test->name</a>
                    </td>
                    <td>
                        {$test->question->count()}
                    </td>
                    <td>
                    <input type='hidden' name='testx[]' value='$test->id'>
                     <input type='number' name='number[]' style='width:50px;'>
                    </td>
                     </tr>";
                 }
            
            $data.="</tbody>
           
            <tfoot>
                <tr>
                       <th>Нэр</th>
                        <th>MAX</th>
                        <th>Тоо</th>
                </tr>
            </tfoot>
        </table>";

 return $data;          
}

//User test iig gargadag function
function display_test($id){
    //$questions= Question::select('id','question','level')->where('test_id','=',$request["testx"][$i])->get(); 
    //flight = App\Flight::where('active', 1)->first();
    $stest = Stest::where([['user_id','=',$id],['status','=',1],])->first(); 
    //$stest = Stest::select('id','name','score','status')->where('user_id','=',$id)->get(); 

    $data='<h1>'.$stest->name.' шалгалт</h1>';
   //   $data.=$stest->squestions;
     foreach ($stest->squestion as $qlist){
           $data.=$qlist->question.'<br>';
     }
    //     <div id="accordion{{$qlist->id}}">
    //       <div class="card">
    //         <div class="card-header" id="heading{{$qlist->id}}">
    //           <table class="table table-bordered">
    //             <tr>
    //               <th scope="row"  style="width:10px;"data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
    //                 {{$pos}}.&nbsp;
    //               </th>
    //               <td data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
    //                 {{$qlist->question ?: 'DB error!!!'}} 
    //               </td>
    //               <td style="width:25%;">
    //                 {!!Form::open(['action'=>['QuestionController@destroy',$qlist->id],'method'=>'POST'])!!} 
    //                 <button type="button" class="btn btn-success" data-toggle="modal" data-myid="{{$qlist->id}}"
    //                 data-target="#questionmodal">Нэмэх</button>
    //                 <a href="/question/{{$qlist->id}}/edit" class="btn btn-warning">Засах</a>  
    //                 {{Form::hidden('_method','DELETE')}}
    //                 {{Form::submit('Усатгах',['class'=>'btn btn-danger','onclick'=>'return myFunction();'])}}
    //                 {!!Form::close()!!}
                    
    //               </td>
    //             </tr>
    //           </table>
    //         </div>
    //         <div id="collapse{{$qlist->id}}" class="collapse" aria-labelledby="heading{{$qlist->id}}" data-parent="#accordion{{$qlist->id}}">
    //           <div class="card-body">
    //             
    //             @foreach ($qlist->answer as $alist)
    //               <table class="table table-bordered" data-toggle="collapse" data-target="#collapse{{$qlist->id}}" aria-expanded="false" aria-controls="collapse{{$qlist->id}}">
    //                 <tr>
    //                   <th scope="row"  style="width:10px;">
    //                     {{$pos1}}.&nbsp;
    //                   </th>
    //                   @if ($alist->score==1)
    //                     <td class="table-success">
    //                       {{$alist->answer}}
    //                     </td>        
    //                   @else
    //                     <td>
    //                       {{$alist->answer}} 
    //                     </td>    
    //                   @endif
    //                   <td style="width:20%;">
    //                     {!!Form::open(['action'=>['AnswerController@destroy',$alist->id],'method'=>'POST'])!!} 
   
    //                     <a href="/answer/{{$alist->id}}/edit" class="btn btn-warning">Засах</a>  
    //                     {{Form::hidden('_method','DELETE')}}
    //                     {{Form::submit('Усатгах',['class'=>'btn btn-danger','onclick'=>'return myFunction();'])}}
    //                     {{-- <img src='{{ URL::to('/') }}/images/delete.png' alt="Усатгах" onclick="return myFunction();"> --}}
    //                     {!!Form::close()!!}
                        
    //                   </td>
    //                 </tr>
    //               </table>
    //             
    //             @endforeach
                
    //           </div>
    //         </div>
    //       </div>
    //     </div>
    //    
   
    
    
    return $data;
    //return $id;
}