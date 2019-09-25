<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squestion extends Model
{
    public function stest()
    {
        return $this->belongsTo('App\Stest');
    }
    public function sanswer()
        {
        return $this->hasMany('App\Sanswer');
        }

}
