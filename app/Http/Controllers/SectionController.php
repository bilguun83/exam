<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
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

        $sections = Section::orderBy('id','asc')->paginate(10);
        return view("section.index")->with('sections',$sections); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('section.create');
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
        $section = new Section;
        $section->name =$request->input('name');
        $section->save();
        return redirect('/admin/section')->with('success','Хэсэг нэмлээ');
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
        $section =Section::find($id);
        
         return view('section.edit')->with('section',$section);
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

            $section = Section::find($id);
            $section->name =$request->input('name');
            $section->save();
            return redirect('/admin/section')->with('success','Хэсэгийн мэдээллийг шинэчиллээ');
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
        $section = Section::find($id);
        $section->delete();
        return redirect('/admin/section')->with('success','Хэсгийг усатгав');
    }
}
