<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public function test()
    {
        return $this->belongsTo('App\Test');
    }
}
