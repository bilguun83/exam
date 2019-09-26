<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Test;
use App\Stest;
use App\Question;
use App\Squestion;
use App\Answer;
use App\Sanswer;
class ExamController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function request($id)
    {
        //
        //echo "Request is made:".$id;
        $student = User::find($id);
        
        $student->status =2;
         
        $student->save();
        return back()->with('success','Хүсэлтийг ажилттай илгээв');
    }
    public function request1($id)
    {
        //
        //echo "Request is made:".$id;
        $student = User::find($id);
        $student->status =4;
        $student->save();
        $score=0;
        $stest = Stest::where([['user_id','=',$id],['status','=',1],])->first(); 
        $squestions= Squestion::select('id')->where('stest_id','=',$stest->id)->get(); 
        foreach ($squestions as $squestion)
            { 
                $sanswers= Sanswer::select('selected','score')->where('squestion_id','=',$squestion->id)->get();
                foreach ($sanswers as $sanswer){
                    if($sanswer->selected==true and $sanswer->score==1 ){
                        $score++;
                    }
                }
            }


        $stest->score=$score;
        $stest->status=2;
        $stest->save();
        
        return back()->with('success','Шалгалтыг дуусгав');
    }
    //TEST iin onootoi tailtsaad busaad USER status 1 bolno
    public function request2($id)
    {
        //
        //echo "Request is made:".$id;
        $student = User::find($id);
        $student->status =1;
        $student->save();
        $stest = Stest::where([['user_id','=',$id],['status','=',2],])->first();
        $stest->status=3;
        $stest->save();
        return back();
    }
    public function makeExam(Request $request)
    {
        //
        $this->validate($request, [
            'user_id'=>'required',
            'test_name'=>'required',
            ]);
        // echo "Your ID is:".$request->user_id;
        // echo "<br>TEst_name:".$request->test_name;
        
        
//User Test Creation is here
        $stest = new Stest;
        $stest->user_id =$request->input('user_id');
        $stest->section_id =$request->input('section_id');
        $stest->name =$request->input('test_name');
        $stest->save();

        
    $number = count($request["number"]);
$total=0;
    if($number > 0)  
    {  
      for($i=0; $i<$number; $i++)  
      {  
           if($request["number"][$i] != '')  
           {  
               
    
            
            $questions= Question::select('id','question','level')->where('test_id','=',$request["testx"][$i])->inRandomOrder()->limit($request["number"][$i])->get(); 
            foreach ($questions as $question)
            {   
                $total++;
                $squestion = new Squestion;
                $squestion->stest_id =$stest->id;
                $squestion->question =$question->question;
                $squestion->level =$question->level;
                $squestion->save();
                $answers= Answer::select('answer','score')->where('question_id','=',$question->id)->inRandomOrder()->get();
                foreach ($answers as $answer){
                    $sanswer= new Sanswer;
                    $sanswer->squestion_id=$squestion->id;
                    $sanswer->answer=$answer->answer;
                    $sanswer->score=$answer->score;
                    $sanswer->save();
                }
               
            }

           }
     }
    }
    //echo "<br>Total:".$total;
    $stest->total=$total;
    $stest->status=1;
    $stest->save();
    
    $student = User::find($stest->user_id);
        
    $student->status =3;
    $student->save();
    return back()->with('success','Шалгалтыг үүсгэв');
}

public function print(Request $request)
{
    //
    $this->validate($request, [
        'stest_id'=>'required',
        'choice'=>'required',
        ]);

    $stest = Stest::find($request->input('stest_id'));         
    $user = user::find($stest->user_id);
    
    //return view('student.print')->with(['stest',$stest],['user',$user],['choice',$request->input('choice')]);
    return view('student.print')->with('stest',$stest)->with('user',$user)->with('choice',$request->input('choice'));

}

function postdata(Request $request)

{

    Sanswer::updateData($request->input('id'), $request->input('q_id'));
    echo json_encode(array('status' =>'success' ));
}

}

