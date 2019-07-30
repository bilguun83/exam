<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Section;
//use DB;

class TestController extends Controller
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
//        echo "hello";

            // $tests= Test::all(); //Select * from test
            //$tests= Test::where('name','VHF')->get();
            // $tests= DB::select('Select * from tests'); //use DB in declaration
            //$tests= Test::orderBy('name','asc')->take(1)->get();
            //$tests= Test::orderBy('name','asc')->get();
            
            $tests= Test::orderBy('name','asc')->paginate(10);
            $sections = Section::all();
            return view("test.index")->with('tests',$tests)->with('sections',$sections); 
    }

    public function sections()
    {
        return $this->hasOne('App\Section');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //echo "create function ";
        return view('test.create');
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
        'name'=>'required',
        ]);
        
        //create test
        $test = new Test;
        $test->name =$request->input('name');
        $test->section_id =$request->input('section_id');
        $test->save();
        return redirect('/admin/test')->with('success','Test Created');
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
        $test =Test::find($id);
        return view('test.show')->with('test',$test);
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
        $test =Test::find($id);
        
        
        return view('test.edit')->with('test',$test);
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
            'name'=>'required',
            ]);
            
            //create test
            $test = Test::find($id);
            $test->name =$request->input('name');
            $test->section_id =$request->input('section_id');
            $test->save();
            return redirect('/admin/test')->with('success','Test updated');
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
        $test = Test::find($id);
        $test->delete();
        return redirect('/admin/test')->with('success','Test deleted');
    }
}
