<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function test()
    {
        return $this->belongsTo('App\Question');
    }
}
