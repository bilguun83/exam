<?php
use App\Section;
use App\Test;


function global_function_example($str)
{
   return 'A Global Function with '. $str;
}

function section_select($id){

   $sections = Section::all();
   $data = "<select name='section_id' placeholder='Хэсэг' class='form-control'>";
   
   foreach ($sections as $section){
       if ($section->id ==$id)
           $data.="<option value='".$section->id."' selected>".$section->name."</option>";   
       else
       $data.="<option value='".$section->id."'>".$section->name."</option>";     
       
             }
   $data.="</select>";
   return $data;          
}

function alltest(){

   $tests = Test::all();
   $data = "
   <input type='text' name='test_name' class='form-control'><br>";
   $data.=section_select(1);
   $data.="<table id='table' class='table table-striped table-bordered' cellspacing='0' width='100%'>
                <thead>
                    <tr>
                        <th >Нэр</th>
                        <th style='width:10px;'>Max</th>
                        <th style='width:50px;'>Тоо</th>
                    </tr>
                </thead>
                <tbody>";
         
                foreach ($tests as $test){
                $data.="<tr>
                   <td>
                     <a href='/admin/test/$test->id/view' target='_blank' tabindex='-1'>$test->name</a>
                    </td>
                    <td>
                        {$test->question->count()}
                    </td>
                    <td>
                    <input type='hidden' name='testx[]' value='$test->id'>
                     <input type='number' name='number[]' style='width:50px;'>
                    </td>
                     </tr>";
                 }
            
            $data.="</tbody>
           
            <tfoot>
                <tr>
                       <th>Нэр</th>
                        <th>MAX</th>
                        <th>Тоо</th>
                </tr>
            </tfoot>
        </table>";

 return $data;          
}