<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Stest;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = User::orderBy('fname','asc')->paginate(10);
        return view("student.index")->with('students',$students); 
    }

    public function request()
    {
        //
        $students = User::where('status','<>',1)->orderBy('fname','asc')->paginate(10);
        return view("student.request")->with('students',$students); 
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
        $student =User::find($id);
        
        return view('student.edit')->with('student',$student);
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
            'lname'=>'required',
            'fname'=>'required',
            'school'=>'required', 
            'field'=>'required', 
            'degree'=>'required', 
            'position'=>'required', 
            'email'=>'required', 
            
            ]);
            
            $student = User::find($id);
            $student->fname =$request->input('fname');
            $student->lname =$request->input('lname');
            $student->school =$request->input('school');
            $student->field =$request->input('field');
            $student->degree =$request->input('degree');
            $student->position =$request->input('position');
            $student->email =$request->input('email');
             if ($request->input('password')!=NULL)
            $student->password =Hash::make($request->input('password'));
            $student->group_id=$request->input('group');
            

            $student->save();
            return redirect('/admin/student')->with('success','Хэрэглэгчийн мэдээллийг шинэчиллээ');
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

    //SHALGALTIIN tuuh
    public function history()
    {
        //
        $stests = Stest::where('status','=',3)->orderBy('updated_at','asc')->paginate(10);
        return view("student.history")->with('stests',$stests); 
    }

}
