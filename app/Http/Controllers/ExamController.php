<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Test;
use App\Stest;

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
        echo "Your ID is:".$request->user_id;
        echo "<br>TEst_name:".$request->test_name;
        echo "<br>TEst:".$request->number[6];

        $stest = new Stest;
        $stest->user_id =$request->input('user_id');
        $stest->section_id =$request->input('section_id');
        $stest->name =$request->input('test_name');
        
        $stest->save();   
        //echo "Selected RAdio is:".$request->correct."<br>";
    // $number = count($request["answer"]);

    // if($number > 0)  
    // {  
    //   for($i=0; $i<$number; $i++)  
    //   {  
    //        if($request["answer"][$i] != '')  
    //        {  
               
    //         $answer = new Answer;
    //         $answer->answer =$request["answer"][$i];
    //         $answer->question_id =$question->id;
    //         if ($i==0)
    //         $answer->score =1;
    //         $answer->save();   

     }
}
