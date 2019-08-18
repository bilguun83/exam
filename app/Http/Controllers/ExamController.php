<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

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
}
