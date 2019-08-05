<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['question', 'test_id', 'level'];

    public function test()
    {
        return $this->belongsTo('App\Test');
    }
    public function Answer()
        {
        return $this->hasMany('App\Answer');
        }

}
