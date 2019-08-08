<?php
namespace App\Imports;
use App\Test;
use App\Question;
use App\Answer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Question1 implements ToCollection
{
    public function collection(Collection $rows)
    {
        $test = Test::orderBy('created_at', 'desc')->first();
        foreach ($rows as $row) 
        {
            $data = Question::create([
                'question' => $row[0],
                'test_id'=> $test->id, 
                'level'=> $row[6], 
            ]);
            

            for ($x=1; $x<=4; $x++){
                
                if(isset($row[$x]) and !empty($row[$x])){
                    if($x==$row[5]){
                        Answer::create([
                            'answer'=>$row[$x],
                            'question_id'=> $data->id, 
                            'score'=>'1',
                            'test_id'=> $test->id, 
                        ]);
                    }
                    else{
                        Answer::create([
                            'answer'=>$row[$x],
                            'question_id'=> $data->id,
                            'score'=>'0',
                        ]);
                    }
                }
            }   
        }
    }
}