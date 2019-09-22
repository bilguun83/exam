<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stest extends Model
{
    //
    protected $table='stests';

    public $primaryKey='id';
    public $timestamps = true;
    
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function Section(){

        return $this->hasOne('App\Section');
        }
   
    public function Squestion()
        {
        return $this->hasMany('App\Squestion');
        }
  
        public function Sanswer()
    {
        return $this->hasManyThrough('App\Sanswer', 'App\Squestion');
    }
}
