<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    // protected $table='question';
    protected $fillable = ['question', 'test_id', 'level'];
    // public $primaryKey='id';
    // public $question='question';
    // public $test_id='test_id';
    // public $level='level';
    // public $timestamps = true;

    public function test()
    {
        return $this->belongsTo('App\Test');
    }
    public function Answer()
        {
        return $this->hasMany('App\Answer');
        }

}
