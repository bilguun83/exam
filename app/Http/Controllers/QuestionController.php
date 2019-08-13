<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Question;
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
    echo "Asuult: ".$request->newquestion."<br>Testid: ".$request->test_id;
    $number = count($request["answer"]);
    echo "<br>hariultuud: ".$number."<br>";

    if($number > 0)  
    {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($request["answer"][$i] != ''))  
           {  
                echo 'answer: '.$request["answer"][$i].'<br>';
           }  
      }  
      }  
    else  
    {  
      echo "Please Enter Name";  
    }
    //     $question = new Question;
    //     $question->question =$request->input('newquestion');
    //     $question->test_id =$request->input('test_id');
    //     $question->save();
    
    //     //     // Excel::import(new QuestionImport,request()->file('file'));
    //     //     Excel::import(new Question1,request()->file('file'));
    //     //    // Excel::import(new UsersImport, 'users.xlsx');
            
    //  //return redirect('/admin/test')->with('success','Test Created');
    //  return back()->with('success','Test Created');
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
    }
}
