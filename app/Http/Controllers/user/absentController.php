<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\excuse;
use App\Models\official_vacation;
use App\Models\employee_leave;


use App\Models\Shift;
use Validator;

use \Carbon\CarbonPeriod;


use Illuminate\Support\Facades\Auth;

class absentController extends Controller
{

public function absentCalculator(){ //needs to print $absentDays in table and control $from $to
    $from='2021-04-1'; //input
    $to='2021-04-30'; //input
    $absentDays=[];
    $total=0;
   
   $offical_vaccation=official_vacation::all();
   $employee_leaves=employee_leave::all();
    $period = CarbonPeriod::create($from,$to);
//-----------absent! -------------------------
    foreach ($period as $day) {
        $absent=0;
         $posts= Post::all();
         $postDate=Post::where('date',$day)->first();
    
         if($postDate==null){
            $absent++;
            
         }
      
         
        // foreach($posts as $post){
        //     $postDate=Carbon::parse($post->date.' 00:00:00');
         
        //     if($postDate->ne($day)){
        //         $absent++;
        //        echo "absent ";
        //     }
           
           
          
        // }// end absent foreach
            



             //-----------not week end ! -------------------------
    if ($day->isWeekend()){
       $absent=0;
      
    }
         //-----------not Official vacation ! -------------------------
            foreach( $offical_vaccation as $oV){
                $start=Carbon::parse($oV->start.' 00:00:00');
                
                $end= Carbon::parse($oV->end.' 00:00:00'); 
                
                if($day->gte( $start )&& $day->lte( $end)){
                    $absent=0;
                    
                }
             }////---------end Official vacation foreach-----------------
             
             //-----------not employee leave ! -------------------------
             foreach( $employee_leaves as $eL){
                $start=Carbon::parse($eL->start.' 00:00:00');
                
                $end= Carbon::parse($eL->end.' 00:00:00'); 
                
                if($day->gte( $start )&& $day->lte( $end)){
                    $absent=0;
                   
                }
             }////---------end employee leaves foreach-----------------
             if($absent!=0){
                $total=$total+$absent;
                array_push($absentDays,$day);
                
             }
             
          
          
                }//end foreach
                foreach($absentDays as $aD){
                   echo $aD->toDateString()." ";
                }
              
  return $total;
                //dd($total);
}

}