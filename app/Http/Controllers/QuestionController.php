<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Question;
use App\Answer;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('teacher');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'newquestion'=>'required',
            ]);
        $question = new Question;
        $question->question =$request->input('newquestion');
        $question->test_id =$request->input('test_id');
        $question->save();   
        //echo "Selected RAdio is:".$request->correct."<br>";
    $number = count($request["answer"]);

    if($number > 0)  
    {  
      for($i=0; $i<$number; $i++)  
      {  
           if($request["answer"][$i] != '')  
           {  
               
            $answer = new Answer;
            $answer->answer =$request["answer"][$i];
            $answer->question_id =$question->id;
            if ($i==0)
            $answer->score =1;
            $answer->save();   
        //   echo "Ansswer:".$i.": ".$request["answer"][$i]."<br>";
   
           }  
      }  
      }  


    //  //return redirect('/admin/test')->with('success','Test Created');
    return back()->with('success','Асуулт нэмэгдлээ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question =Question::find($id);
        return view('question.edit')->with('question',$question);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'question'=>'required',
            ]);
            
            //answer create test
            $question = question::find($id);
            $question->question =$request->input('question');
            
            $question->save();
            return redirect('/admin/test/'.$question->test_id.'/view')->with('success','Question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $question = Question::find($id);
        $question->answer()->delete();
        $question->delete(); 
        
        return back()->with('success','Асуулт хасагдлаа');
//        redirect('/admin/test')->with('success','Test deleted');
    }
 

}
