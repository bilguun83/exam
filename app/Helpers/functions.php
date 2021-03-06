<?php
use App\Section;
use App\Test;
use App\Stest;
use App\Squesiton;
use App\Sanswer;
use App\User;


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
function display_group($id){
    $section = Section::find($id);
    return $section->name;
}
function display_userinfo($id){
    $user = User::find($id);
    $data=$user->lname.' '.$user->fname;
    return $data;
}
function alltest(){

   $tests = Test::all()->sortByDesc("section_id");
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

//User test iig gargadag function
function display_test($id){
    
    //$questions= Question::select('id','question','level')->where('test_id','=',$request["testx"][$i])->get(); 
    //flight = App\Flight::where('active', 1)->first();
    $stest = Stest::where([['user_id','=',$id],['status','=',1],])->first(); 
    //$stest = Stest::select('id','name','score','status')->where('user_id','=',$id)->get(); 

    $data='<h1>'.$stest->name.' шалгалт</h1>';
    
   //   $data.=$stest->squestions;
   $j=1;
   $azRange = range('A', 'Z');
 
 
     foreach ($stest->squestion as $qlist){
           $data.='<b>'.$j.'. '.$qlist->question.'</b><br><br>';
           $d=0;
           foreach ($qlist->sanswer as $alist)
           {
            $data.=$azRange[$d].'. ';


            $data.=' <input type="radio" name="radio_'.$qlist->id.'" value="'.$alist->id.'" onchange="handleChange('.$alist->id.','.$qlist->id.')"';
            $data.=$alist->selected == 1 ? "checked" : "";
            $data.='>'.$alist->answer.'<br>';                                    
            // $data.=' <input type="radio" name="'.$qlist->id.'" value="'.$alist->id.'" onclick="show('.$alist->id.')">'.$alist->answer.'<br>';
            $d++;
           }
           $data.='<br>';
           $j++;
     }
  
   
    
    
    return $data;
}

// Herelegchin ur dung haruuldag function
function display_result($id){
$user = user::find($id);
$stest = Stest::where([['user_id','=',$id],['status','=',2],])->first(); 
$azRange = range('A', 'Z');
// if (40 % 20 == 0) {
//     echo '<br>This number is divisible by 6.';
// }

$j=0;
$data1="<table class='table table-bordered text-center' style='font-size:7pt;'>";



  foreach ($stest->squestion as $qlist){
      
       $d=0;
       if ($j % 20 == 0) {
            $data1.="<tr class='m-0 p-0'>";
            for($td=1;$td<21;$td++){
                $data1.="<td>".$td."</td>";
            }
            $data1.="<tr>";
        }
        $j++;
        foreach ($qlist->sanswer as $alist)
        {
            if($alist->selected==true){
                
                if ($alist->score==0){
                    $data1.="<td class='table-info'><del>".$azRange[$d]."</del>";
                }
                else{
                    $data1.="<td>".$azRange[$d];    
                }
                $data1.="</td>";
            }
            $d++;
        }
        
  }
 if ($j % 20 !=0){
  while (($j-1) % 20 !=0){
      $data1.="<td>*</td>";
      $j++;
  }
}   


$data1.="
</tr>
</table>
";
$data='<pre style="font-family:Arial;">
 <b>1. Овог:</b> '.$user->lname.'        <b>Нэр:</b> '.$user->fname.'
 <b>2. Төгссөн сургууль, курс, он:</b> '.$user->school.'
 <b>3. Мэргэжил:</b> '.$user->field.'
 <b>4. Мэргэшлийн зэрэг:</b> '.$user->degree.'
 <b>5. Албан тушаал:</b> '.$user->position.'
 <b>6. Шалгалтын үнэлгээ</b>
 <b>6.1 Тестийн шалгалтын үнэлгээ:</b>
 Шалгалтын тест ('.$stest->name.')
 <b>Асуулт</b>';
//  <b>Шалгалтын тест</b> ';
 
//  .$user->.'
//  <b></b> '.$user->.'
//  <b></b> '.$user->.'
$data.=$data1;
$data.='<b>Шалгалтын дүн: </b>'.($stest->score*100)/$stest->total.'%  ('.$stest->score.'/'.$stest->total.')';
$data.='</pre>
';

    return $data;
}

// function print_result($type){
//     $data='<center>
//             <table>
//               <tr>
//                 <td>
//                   <div class="text-left"><img src="'.URL::to('/').'/images/logo.png">
//                   </div>
//                 </td>
//                 <td>
//                   <h5 style="font-family:Arial;">ХОЛБОО, НАВИГАЦИ, АЖИГЛАЛТЫН АЛБА<BR>МЭРГЭЖЛИЙН СУРГАЛТ, ШАЛГАЛТЫН КОМИСС</h5>
//                 </td>
//               </tr>
//             </table>
// </center><br>';
// return $data;
// }

function display_print($user_id,$stest_id,$choice){
    $user = user::find($user_id);
    $stest = Stest::find($stest_id); 


    $data='
    <center>
    <table>
      <tr>
        <td>
          <div class="text-left"><img src="'.URL::to('/').'/images/logo.png">
          </div>
        </td>
        <td><div class="text-center">';
        if($choice!=5){
          $data.='<h5 style="font-family:Arial;">ХОЛБОО, НАВИГАЦИ, АЖИГЛАЛТЫН АЛБА<BR>МЭРГЭЖЛИЙН СУРГАЛТ, ШАЛГАЛТЫН КОМИСС</h5>';
        }
        else{
            $data.='<h5 style="font-family:Arial;">ХОЛБОО, НАВИГАЦИ, АЖИГЛАЛТЫН АЛБА<BR>ДҮРМИЙН ШАЛГАЛТЫН КОМИСС</h5>';
        }
        $data.='</div></td>
      </tr>
    </table>
    </center>
<br>';
    $azRange = range('A', 'Z');
    // if (40 % 20 == 0) {
    //     echo '<br>This number is divisible by 6.';
    // }
    
    $j=0;
    $data1="<table class='table table-bordered text-center' style='font-size:7pt;'>";
    
    
    
      foreach ($stest->squestion as $qlist){
          
           $d=0;
           if ($j % 20 == 0) {
                $data1.="<tr class='m-0 p-0'>";
                for($td=1;$td<21;$td++){
                    $data1.="<td>".$td."</td>";
                }
                $data1.="<tr>";
            }
            $j++;
            foreach ($qlist->sanswer as $alist)
            {
                if($alist->selected==true){
                    
                    if ($alist->score==0){
                        $data1.="<td class='table-info'><del>".$azRange[$d]."</del>";
                    }
                    else{
                        $data1.="<td>".$azRange[$d];    
                    }
                    $data1.="</td>";
                }
                $d++;
            }
            
      }
     if ($j % 20 !=0){
      while (($j-1) % 20 !=0){
          $data1.="<td>*</td>";
          $j++;
      }
    }   
    
    
    $data1.="
    </tr>
    </table>
    ";
$data.='<pre style="font-family:Arial;border:None">
<b>1. Овог:</b> '.$user->lname.'        <b>Нэр:</b> '.$user->fname.'
<b>2. Төгссөн сургууль, курс, он:</b> '.$user->school.'
<b>3. Мэргэжил:</b> '.$user->field.'
<b>4. Мэргэшлийн зэрэг:</b> '.$user->degree.'
<b>5. Албан тушаал:</b> '.$user->position.'
<b>6. Шалгалтын үнэлгээ</b>
<b>6.1 Тестийн шалгалтын үнэлгээ:</b>
Шалгалтын тест ('.$stest->name.')
<b>Асуулт</b></pre>';
    //  <b>Шалгалтын тест</b> ';
     
    //  .$user->.'
    //  <b></b> '.$user->.'
    //  <b></b> '.$user->.'
    $data.=$data1;
$data.='<pre style="font-family:Arial; border:None">
<b>Шалгалтын дүн: </b>'.($stest->score*100)/$stest->total.'%  ('.$stest->score.'/'.$stest->total.')
<b>6.2. Ам шалгалтын үнэлгээ</b>

Шалгалтын дүн:  . . . . . %
<b>6.3. Ажлын байран дахь шалгалтын үнэлгээ</b>

            Шалгалтын дүн:     Хангалттай     Хангалтгүй';
switch ($choice) {
    case 5:
$data.='
<b>7. Дүрмийн шалгалтын комиссын дүгнэлт:</b> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . 
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

<b>8. Шалгуулагчийн гарын үсэг</b>  . . . . . . . . . . . . . . . . . . . . . 

<b>9. Шалгалт авсан хугацаа: </b>
            Тестийн шалгалт:                         . . . . цаг                 Огноо: 20    /      /       /
            Ам шалгалт:                                  . . . . цаг                 Огноо: 20    /      /       /
            Ажлын байран дахь шалгалт:      . . . . цаг                 Огноо: 20    /      /       /
                                                    Нийт:      . . . . цаг

<b>10. Мэргэшлийн үнэмлэхний дугаар:</b> . . . . . . . . 
        Дүрмийн шалгалтын комиссын дарга                                                Х.Баттулга

        Дүрмийн шалгалтын комиссын гишүүд:                                            Ц.Батмөнх

<b>11. Шийдвэр гаргасан огноо:</b>     20    /       /        /                                   Ж.Батбаяр

                                                                                                                      П.Баатар

 Шийдвэр:                                                                                                     Д.Батаа
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

                                            Дарга                       Д.Баяртогтох

<b>12. Шийдвэр гаргасан огноо</b>:           20    /         /             /';
break;

case 1:
$data.='<b>
7. Шалгалтын мэргэжлийн комиссын дүгнэлт:</b> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

<b>8. Шалгуулагчийн гарын үсэг</b>  . . . . . . . . . . . . . . . . . . . . . 

<b>9. Шалгалт авсан хугацаа: </b>
            Тестийн шалгалт:                         . . . . цаг                 Огноо: 20    /      /       /
            Ам шалгалт:                                  . . . . цаг                 Огноо: 20    /      /       /
            Ажлын байран дахь шалгалт:      . . . . цаг                 Огноо: 20    /      /       /
                                                    Нийт:      . . . . цаг

<b>10. Мэргэшлийн үнэмлэхний дугаар:</b> . . . . . . . . 
        Шалгалтын мэргэжлийн комиссын дарга                                                   Б.Очирсүх

        Шалгалтын мэргэжлийн комиссын гишүүд:                                               Х.Баттулга

<b>11. Шийдвэр гаргасан огноо:</b>     20    /       /        /                                            Г.Баттөгс

Ажиллах эрх олгох комиссын шийдвэр:                                                             С.Мөнхбаяр

                                                                                                                               Д.Батаа  

                                                                                                                               Э.Төрбаяр

Шийдвэр:                                                                                                               С.Билгүүн

. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

                                            Дарга                       Д.Баяртогтох

<b>12. Шийдвэр гаргасан огноо</b>:           20    /         /             /';
break;
case 2:
$data.='<b>
7. Шалгалтын мэргэжлийн комиссын дүгнэлт:</b> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

<b>8. Шалгуулагчийн гарын үсэг</b>  . . . . . . . . . . . . . . . . . . . . . 

<b>9. Шалгалт авсан хугацаа: </b>
            Тестийн шалгалт:                         . . . . цаг                 Огноо: 20    /      /       /
            Ам шалгалт:                                  . . . . цаг                 Огноо: 20    /      /       /
            Ажлын байран дахь шалгалт:      . . . . цаг                 Огноо: 20    /      /       /
                                                    Нийт:      . . . . цаг

<b>10. Мэргэшлийн үнэмлэхний дугаар:</b> . . . . . . . . 
        Шалгалтын мэргэжлийн комиссын дарга                                                   Б.Очирсүх

        Шалгалтын мэргэжлийн комиссын гишүүд:                                               Х.Баттулга

<b>11. Шийдвэр гаргасан огноо:</b>     20    /       /        /                                            Г.Баттөгс

Ажиллах эрх олгох комиссын шийдвэр:                                                             С.Мөнхбаяр

                                                                                                                               Д.Батаа  

                                                                                                                               Г.Ганзориг

Шийдвэр:                                                                                                               С.Отгонбаяр

. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

                                            Дарга                       Д.Баяртогтох

<b>12. Шийдвэр гаргасан огноо</b>:           20    /         /             /';
break;
case 3:
$data.='<b>
7. Шалгалтын мэргэжлийн комиссын дүгнэлт:</b> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

<b>8. Шалгуулагчийн гарын үсэг</b>  . . . . . . . . . . . . . . . . . . . . . 

<b>9. Шалгалт авсан хугацаа: </b>
            Тестийн шалгалт:                         . . . . цаг                 Огноо: 20    /      /       /
            Ам шалгалт:                                  . . . . цаг                 Огноо: 20    /      /       /
            Ажлын байран дахь шалгалт:      . . . . цаг                 Огноо: 20    /      /       /
                                                    Нийт:      . . . . цаг

<b>10. Мэргэшлийн үнэмлэхний дугаар:</b> . . . . . . . . 
        Шалгалтын мэргэжлийн комиссын дарга                                                   Б.Очирсүх

        Шалгалтын мэргэжлийн комиссын гишүүд:                                               Х.Баттулга

<b>11. Шийдвэр гаргасан огноо:</b>     20    /       /        /                                            Г.Баттөгс

Ажиллах эрх олгох комиссын шийдвэр:                                                             С.Мөнхбаяр

                                                                                                                               Д.Батаа  

                                                                                                                               Б.Цогоо

Шийдвэр:                                                                                                               Б.Болдаа

. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

                                            Дарга                       Д.Баяртогтох

<b>12. Шийдвэр гаргасан огноо</b>:           20    /         /             /';
break;
case 4:
$data.='<b>
7. Шалгалтын мэргэжлийн комиссын дүгнэлт:</b> . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

<b>8. Шалгуулагчийн гарын үсэг</b>  . . . . . . . . . . . . . . . . . . . . . 

<b>9. Шалгалт авсан хугацаа: </b>
            Тестийн шалгалт:                         . . . . цаг                 Огноо: 20    /      /       /
            Ам шалгалт:                                  . . . . цаг                 Огноо: 20    /      /       /
            Ажлын байран дахь шалгалт:      . . . . цаг                 Огноо: 20    /      /       /
                                                    Нийт:      . . . . цаг

<b>10. Мэргэшлийн үнэмлэхний дугаар:</b> . . . . . . . . 
        Шалгалтын мэргэжлийн комиссын дарга                                                   Б.Очирсүх

        Шалгалтын мэргэжлийн комиссын гишүүд:                                               Х.Баттулга

<b>11. Шийдвэр гаргасан огноо:</b>     20    /       /        /                                            Г.Баттөгс

Ажиллах эрх олгох комиссын шийдвэр:                                                             С.Мөнхбаяр

                                                                                                                               Д.Батаа  

                                                                                                                               Ж.Батбаяр

Шийдвэр:                                                                                                               Ц.Батмөнх

. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

                                            Дарга                       Д.Баяртогтох

<b>12. Шийдвэр гаргасан огноо</b>:           20    /         /             /';
break;
}
$data.='</pre><button id="agreed_btn" class="btn btn-danger d-print-none" onclick="window.print();">Хэвлэх</button>';
        return $data;
    }

    
