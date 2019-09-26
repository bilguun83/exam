<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Sanswer extends Model
{
    //
    public function squestion()
    {
        return $this->belongsTo('App\Squestion');
    }
    public static function updateData($id,$qid){
        DB::table('sanswers')
        ->where('squestion_id','=', $qid)
        ->update(['selected' => false]);
        DB::table('sanswers')
        ->where('id','=', $id)
        ->update(['selected' => true]); 
     }
}
