<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        //
        $student =User::find($id);
        
        return view('student.profile')->with('student',$student);
    }
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
           
            $student->save();
            return redirect('/profile'.'/'.$id.'/edit')->with('success','Хэрэглэгчийн мэдээллийг шинэчиллээ');
    }
}
