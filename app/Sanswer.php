<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanswer extends Model
{
    //
    public function squestion()
    {
        return $this->belongsTo('App\Squestion');
    }
}
