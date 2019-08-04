<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $table='tests';

    public $primaryKey='id';
    public $timestamps = true;
    
    public function Section(){

        return $this->hasOne('App\Section');
         }
    
    public function Question()
        {
        return $this->hasMany('App\Question');
        }
}
