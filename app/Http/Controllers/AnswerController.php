<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use DB;

class AnswerController extends Controller
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
            'question_id'=>'required',
            'answer' => 'required',
            ]);
    
            $answer = new Answer;
            $answer->answer =$request->input('answer');
            $answer->question_id =$request->input('question_id');
            if ($request->correct==1){
                DB::table('answers')
                ->where('question_id', $answer->question_id)
                ->update(['score' => 0]);
                $answer->score=1;
                
            }
            else{
                $answer->score=0;
            }
            

            $answer->save();
    

           return back()->with('success','Answer Created');
     //   echo "question id:".$request->question_id."<br>answer:".$request->answer;
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
        $answer =Answer::find($id);
        return view('answer.edit')->with('answer',$answer);
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
            'answer'=>'required',
            ]);
            
        
        $answer = Answer::find($id);
        $answer->answer =$request->input('answer');

        if ($request->correct==true){
            DB::table('answers')
            ->where([
                    ['question_id','=', $answer->question_id],
                    ['id','<>',$answer->id],
                    ])
            ->update(['score' => 0]);
            
            $answer->score=1;
        }
        else{
             $answer->score=0;
            }
            //echo $request->correct;
        $answer->save();    
        $question=Question::find($answer->question_id);
        
       return redirect('/admin/test/'.$question->test_id.'/view')->with('success','Answer updated');
// //         return back()->with('success','Answer updated');
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
        $answer = Answer::find($id);
        $answer->delete();
        
        return back()->with('success','Хариулт хасагдлаа');
    }
    public function addanswer($id)
    {
        //
           //Tuhain asuultad hariult nemj baigaa function
        echo "ADD answer:".$id;
  }
}
