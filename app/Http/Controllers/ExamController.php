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

    if($number > 0)  
    {  
      for($i=0; $i<$number; $i++)  
      {  
           if($request["number"][$i] != '')  
           {  
               
     //       echo "<br>".$i." data:".$request["number"][$i]." ID:".$request["testx"][$i];
            
            $questions= Question::select('id','question','level')->where('test_id','=',$request["testx"][$i])->inRandomOrder()->get()->random($request["number"][$i]); 
            foreach ($questions as $question)
            {
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
                echo "<br>Question:".$question."<br>Answer:".$answers;
            }
            //Table::select('name','surname')->where('id', 1)->get();
            //echo '<br>TEST is:'.$questions;
           }
     }
    }
    $student = User::find($stest->user_id);
        
    $student->status =3;
    $student->save();
}
}
