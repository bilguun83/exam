<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;
  
class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('test.excel');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        Echo "Export is here";
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new QuestionImport,request()->file('file'));
           
        return back();
    }
}