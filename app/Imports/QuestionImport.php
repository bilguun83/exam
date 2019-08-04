<?php

namespace App\Imports;
use App\Test;
use App\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $test = Test::orderBy('created_at', 'desc')->first();

        return new Question([
            //
            'question'=> $row['question'],
            'test_id'=> $test->id, 
            'level'=> $row['level'], 
        ]);
    }
}
