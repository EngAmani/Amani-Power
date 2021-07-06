<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Employee_leave;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amana_id',
        'company_id',
        'Administration',
        'role',
        'leaveBalance',
        'emergencyLesve',
        'name',
        'email',
        'password',
    ];

    public function shifts()
    {
        return $this->belongsToMany(Shift::class,'user_shift');
    }
    public function isCheckedIn(){
        $dt = Carbon::now();
       // $dt->toDateString();
        $checkedIn = Auth::user()->posts->where('date',$dt->toDateString())->where('time_out',null)->count();
    //dd($checkedIn,empty($checkedIn));
        if($checkedIn == 0){
            return false;
        }else{
            return true;
        }
        
    }
    public function passedLimit(){
        $limit = 3; 
        $dt = Carbon::now();
        $count_attends = Auth::user()->posts->where('date',$dt->toDateString())->where('time_out','<>',null)->where('time_in','<>',null)->count();
        return $limit <= $count_attends;
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 protected $table="users";
   public function posts(){
       return $this->hasMany(Post::class);
   }

   public function employee_leaves(){
    return $this->hasMany(Employee_leave::class);
}

   public function excuses(){
    return $this->hasMany(excuse::class);
}


public function calc($id=null,$month=null,$numbers=false,$d=null){//recived input //calculate lateness
    // to be reviwed later concidering the shift table !
    $attend=0;
    $leave=0;

    // if($request->has('info_range')){
    //  dd( $request->info_range);
    // }


$user=User::where('id',$id)->first();
$shiftStart='08:10:00';
$shiftEnd='16:00:00';
if(isset($user->shifts)){
foreach($user->shifts as $ush){
    $shiftStart=$ush->from;
    $shiftEnd=$ush->to;

}
}


            
    $totalLate=0;
    // $user=Auth::user()->id; //no need !
    $posts=Post::all()->where('user_id',$id);
    if(isset($id)){
        $user=$id;
    }
    
    if(empty($month)){
        $month = now()->format('M Y');
   
    }

  
    

        //dd($id,$month,$from,$to);
        $from= new Carbon($month); 
        $from = $from->format('Y-m-d');
        $to=new Carbon($month);
        $to = $to->endOfMonth(); 
    $today=Carbon::today();
    // dd($today);
    if($to->gt($today) ){
      $to=$today;
    }



    $day=$from;
    $totalLate=0;
    $period = CarbonPeriod::create($from,$to);
   
$i=0;
$counterLate=0;
    // Iterate over the period
    foreach ($period as $day) {


        $late=0;
        $late2=0;
      $postfirst=Post::where('user_id',$user)->where('date',$day)->first(); 
     
      $postlast=Post::where('user_id',$user)->where('date',$day)->latest()->first();
      if($postfirst!=null){
        $late=0;
        $late2=0;
        // $workStart= Carbon::parse($postfirst->date.$shiftStart); //consider shift table !
        // $workEnds= Carbon::parse($postlast->date.$shiftEnd);// consider shift table !
$now=carbon::now();
       $attend=Carbon::parse($postfirst->date.' '.$postfirst->time_in);
       $earlyGo=Carbon::parse($postlast->date.' '.$postlast->time_out);
    //    $workStart= Carbon::parse($postfirst->date.' 08:00:00'); //consider shift table !
    //    $workEnds= Carbon::parse($postlast->date.' 16:00:00');// consider shift table !
    $workStart= Carbon::parse($postfirst->date.$shiftStart); //consider shift table !
    $workEnds= Carbon::parse($postlast->date.$shiftEnd);// consider shift table !
       
    //    $flixbalMinutes=Carbon::parse($postfirst->date.' 08:10:00');
       //late grater than 8:10:00
        if($attend->greaterThan($workStart)){
         $late=$attend->diffInMinutes($workStart);

          if( $shiftStart=='08:10:00'){
            $late=$late+10;        }

         
        }
        //early out


                if($earlyGo->lessThan($workEnds)){
                $late2=$earlyGo->diffInMinutes($workEnds);
                if( $shiftEnd=='15:50:00'){
                    $late2=$late2+10;
            }}

            if($postlast->time_out==null){
                $earlyGo=$attend;
                $late2=$earlyGo->diffInMinutes($workEnds);
                $late2= $late2+10;
            }
          
            if($postlast->time_out==null && $postlast->time_in==!null && $shiftEnd > $now){
                $late2=0;
            }
                // if($day==$today){
                //     $late2=0;
                // }
               
  
     

                            if(($postfirst!=null) && ( $late!=0 || $late2!=0)){ //sum
                            $totalLate=$late+$late2+$totalLate;
                            $counterLate++;
                            }
  

      }//end if post first not null
    
    }//end foreach day
    // dd($totalLate,$late,$late2);
 $hours=(int)($totalLate/60);
  $minutes=(int)($totalLate%60);

    if($d==1){
        return  $counterLate++;
    }
  if($numbers){
  
    return $totalLate;
  }

  else {
    return $hours." ساعات و". $minutes." دقيقة";
  }
   


}     //enf function

public function extraTime($id=null,$month=null,$numbers=false){
//    $user=Auth::user()->id;
  
   $posts=Post::all()->where('user_id',$id);
   if(isset($id)){
       $user=$id;
   }
   
   if(empty($month)){
       $month = now()->format('M Y');
  
   }
   $from= new Carbon($month); 
   $from = $from->format('Y-m-d');
   $to=new Carbon($month);
   $to = $to->endOfMonth(); 
$today=Carbon::today();
// dd($today);
   if($to->gt($today) ){
     $to=$today;
   }

    //$today= Carbon::now();
    $startDate = Carbon::now(); //returns current day
$firstDay = $from;
$firstDay = $to; 


    // $from=Carbon::parse('2021-05-1'); //input
    // $to=Carbon::parse('2021-05-31'); //input

    $extraTime=0;
    $totalExtra=0;
    $period = CarbonPeriod::create($from,$to);


                  foreach ($period as $day) {

                      // make sure if there is X shifts, to check which is applicable for $day 
                      
                    $extraTime=0;
                    $postlast=Post::where('user_id',$user)->where('date',$day)->latest()->first();
            
                    if($postlast!=null){
                      $workEnds= Carbon::parse($postlast->date.' 16:00:00');// no need to consider shift table !
                             $time_out=Carbon::parse($postlast->date.' '.$postlast->time_out); //employee out
                
                                    if($time_out->greaterThan($workEnds)){
                                   $extraTime=$time_out->diffInMinutes($workEnds);
                                    
                                        }
                      
                    }
                    if(($postlast!=null) && ( $extraTime!=0)){ //sum
                    $totalExtra=$extraTime+$totalExtra;}
                  }//
                   
  

$hours=(int)($totalExtra/60);
  $minutes=(int)($totalExtra%60);
  
 
   

   if($numbers){
    return $totalExtra;
  }else{
    return $hours." ساعات و". $minutes." دقيقة" ;
  }
}//enf function !

public function excusesCounter(){
    $user=Auth::user()->id;
    //current month
    
    $excuse=excuse::where('user_id',$user)->count();
   
    return  $excuse;
 }

 public function excusesHours($id=null,$month=null,$numbers=null){
    
    if(isset($id)){
        $user=$id;
    }
    
    $user=User::where('id',$id);

    $total=0;
    //current month

    if(empty($month)){
        $month = now()->format('M Y');
   
    }

    $from= new Carbon($month); 
    $from = $from->format('Y-m-d');
    $to=new Carbon($month);
    $to = $to->endOfMonth(); 
 
$today=Carbon::today();
// dd($today);
    // if($to->gt($today) ){
    //   $to=$today;
    // }
    $period = CarbonPeriod::create($from,$to);

    $excuse=excuse::all()->where('user_id',$id)->whereBetween('date',[ $from, $to]);
    // dd($excuse,$from,$to);
    $counter=0;
    $totalCounter=0;
    if( $excuse!=null){
    foreach ($excuse as $esc){
        $timeEnds=Carbon::parse($esc->date.' '.$esc->to);
       $timeStarts=Carbon::parse($esc->date.' '.$esc->from);
       $divrents=$timeEnds->diffInMinutes($timeStarts);
       $counter++;
    //    $totalCounter= $totalCounter+$counter;
    if($divrents!=0){
         
        $total=$total+$divrents;
        // echo $total."   ";
    }
    }
 
}
    // foreach ($period as $day){
    //     $excuse=excuse::all()->where('user_id',$id)->where('date',$day); //hear is the problem
    //     // dd( $excuse);
    //     $divrents=0;
    //     if( $excuse!=null){
             
            
    //     $timeEnds=Carbon::parse($excuse->date.' '.$excuse->to);
    //     $timeStarts=Carbon::parse($excuse->date.' '.$excuse->from);
        
    //     $divrents=$timeEnds->diffInMinutes($timeStarts);

        
    //     if($divrents!=0){
         
    //         $total=$total+$divrents;
    //         // echo $total."   ";
    //     }

    //     }
  
       
    // //     if($excuse!=null){
       
    // //         $timeEnds=Carbon::parse($excuse->date.' '.$excuse->to);
    // //     $timeStarts=Carbon::parse($excuse->date.' '.$excuse->from);
        
    // //     $divrents=$timeEnds->diffInMinutes($timeStarts);
    // //     }
     
    // //      if($divrents!=0){
    // //         $total=$total+$divrents;
    // //    }

    // }

    if($numbers == 1){
        return $counter;
      }

      if($numbers == 2){
        return $total;
      }
      else{
        $hours=(int)($total/60);
        $minutes=(int)($total%60);
        return $hours." ساعات و". $minutes." دقيقة" ;
      }
   

    
   
      
 }

//$id can not be null ?
 public function absentCalculator($id=null,$month=null,$numbers=false){ //needs to print $absentDays in table and control $from $to
    // $user=Auth::user()->id;
    // $posts=Post::all()->where('user_id',$user);
    if(isset($id)){
        $user_id=$id;
        $user=User::where('id',$user_id);
    }
   
    if(empty($month)){
        $month = now()->format('M Y');
   
    }

    $from= new Carbon($month); 
    // $from = $from->format('Y-m-d');
    $to=new Carbon($month);
    $to = $to->endOfMonth(); 
  
$today=Carbon::today();
// dd($today);
    if($to->gt($today) ){
      $to=$today;
    }

    $absentDays=[];
    $total=0;
   
   $offical_vaccation=official_vacation::all();
   $employee_leaves=Employee_leave::all()->where('user_id',$id);
    $period = CarbonPeriod::create($from,$to);
    $posts= Post::all()->where('user_id',$id);
 
//-----------absent! -------------------------
    foreach ($period as $day) {
        $absent=0;
      
        
        //   $day=$day->format('D M Y');
      
         $postDate=Post::where('date',$day)->where('user_id',$id)->first();
     
        //  $postDate1=Post::where('date','2021-5-27')->first();
        //  dd(  $postDate1);
         if($postDate==null){
            $absent++;
         }
        //  else if($postDate!=null){
        //     // echo $day;
        // echo $postDate->date."  ";
        //  }

         
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
             

        // foreach($absentDays as $abDay){
        //     echo $abDay;
        // }
          
                }//end foreach

                // foreach($absentDays as $aD){
                //    echo $aD->toDateString()." ";
                // }
 

                if($numbers){
                    return $total;
                  }else{
                    return $total." يوم";
                  }
}

// public function calcAbsentPDF($id,$month){
//     $from= new Carbon($month); 
//     $from = $from->format('Y-m-d');
//     $to=new Carbon($month);
//     $to = $to->endOfMonth(); 
// $today=Carbon::today();
// // dd($today);
//     if($to->gt($today) ){
//       $to=$today;
//     }
 
//     $absentDays=[];
//     $total=0;
   
//    $offical_vaccation=official_vacation::all();
//    $employee_leaves=Employee_leave::all();
//     $period = CarbonPeriod::create($from,$to);
// //-----------absent! -------------------------
//     foreach ($period as $day) {
//         $absent=0;
//          $posts= Post::all();
//          $postDate=Post::where('date',$day)->first();
    
//          if($postDate==null){
//             $absent++;
            
//          }
      
         
//         // foreach($posts as $post){
//         //     $postDate=Carbon::parse($post->date.' 00:00:00');
         
//         //     if($postDate->ne($day)){
//         //         $absent++;
//         //        echo "absent ";
//         //     }
           
           
          
//         // }// end absent foreach
            



//              //-----------not week end ! -------------------------
//     if ($day->isWeekend()){
//        $absent=0;
      
//     }
//          //-----------not Official vacation ! -------------------------
//             foreach( $offical_vaccation as $oV){
//                 $start=Carbon::parse($oV->start.' 00:00:00');
                
//                 $end= Carbon::parse($oV->end.' 00:00:00'); 
                
//                 if($day->gte( $start )&& $day->lte( $end)){
//                     $absent=0;
                    
//                 }
//              }////---------end Official vacation foreach-----------------
             
//              //-----------not employee leave ! -------------------------
//              foreach( $employee_leaves as $eL){
//                 $start=Carbon::parse($eL->start.' 00:00:00');
                
//                 $end= Carbon::parse($eL->end.' 00:00:00'); 
                
//                 if($day->gte( $start )&& $day->lte( $end)){
//                     $absent=0;
                   
//                 }
//              }////---------end employee leaves foreach-----------------
//              if($absent!=0){
//                 $total=$total+$absent;
//                 array_push($absentDays,$day);
                
//              }
             
          
          
//                 }//end foreach

//                 // foreach($absentDays as $aD){
//                 //    echo $aD->toDateString()." ";
//                 // }
               
//   return $total;
// }

public function calcVaccationPDF($month,$id){ //e3tyadii

    $user=User::where('id',$id);

    $leaves=Employee_leave::all();
   
    $from= new Carbon($month); 
    //$from = $from->format('Y-m-d');
    $to=new Carbon($month);
   
    $to = $to->endOfMonth(); 
$today=Carbon::today();
// dd($today);
    if($to->gt($today) ){
      $to=$today;
    }
    $count=0;
foreach($leaves as $leave){
    $start=new Carbon($leave->start);
    $end=new Carbon($leave->end);


    if($leave->user_id==$id){
     
if(($start->gte($from))&&($end->lte($to)&&($leave->title=="اعتيادي"))){
    $period = CarbonPeriod::create($start,$end);
    foreach ($period as $day){
     $count++;
    }//end foreach

}//end if between dates

else if(($start->lt($from))&&(($end->lte($to) && $end->gte($from))&&($leave->title=="اعتيادي"))){
    $start=$from;
    $period = CarbonPeriod::create($start,$end);
    foreach ($period as $day){
     $count++;
    }//end foreach

}

else if(($start->gte($from))&&(($start->lte($to) && $end->gt($end))&&($leave->title=="اعتيادي"))){
    $end=$to;
    $period = CarbonPeriod::create($start,$end);
    foreach ($period as $day){
     $count++;
    }//end foreach

}

    }//end if vacc belong to selected employee from dropdawon list 
}//end for each vacc
return $count;
}//end vacc function


public function calcSickLeavePDF($month,$id){ //mara6'y
    
    $user=User::where('id',$id);

    $leaves=Employee_leave::all();
   
    $from= new Carbon($month); 
    //$from = $from->format('Y-m-d');
    $to=new Carbon($month);
   
    $to = $to->endOfMonth(); 
$today=Carbon::today();
// dd($today);
    if($to->gt($today) ){
      $to=$today;
    }
    $count=0;
foreach($leaves as $leave){
    $start=new Carbon($leave->start);
    $end=new Carbon($leave->end);


    if($leave->user_id==$id){
     
    if(($start->gte($from))&&($end->lte($to)&&($leave->title=="مرضي"))){
        $period = CarbonPeriod::create($start,$end);
        foreach ($period as $day){
        $count++;
        }//end foreach

}//end if between dates

    }//end if vacc belong to selected employee from dropdawon list 
}//end for each vacc
return $count;
}//end vacc function

public function calcDeathLeavePDF($month,$id){ //mara6'y
    
    $user=User::where('id',$id);

    $leaves=Employee_leave::all();
   
    $from= new Carbon($month); 
    //$from = $from->format('Y-m-d');
    $to=new Carbon($month);
   
    $to = $to->endOfMonth(); 
$today=Carbon::today();
// dd($today);
    if($to->gt($today) ){
      $to=$today;
    }
    $count=0;
foreach($leaves as $leave){
    $start=new Carbon($leave->start);
    $end=new Carbon($leave->end);


    if($leave->user_id==$id){
     
    if(($start->gte($from))&&($end->lte($to)&&($leave->title=="وفاة"))){
        $period = CarbonPeriod::create($start,$end);
        foreach ($period as $day){
        $count++;
        }//end foreach

}//end if between dates

    }//end if vacc belong to selected employee from dropdawon list 
}//end for each vacc
return $count;
}//end vacc function

        public function annual_leave_calc($id=null,$month=null,$number=false){
              if(isset($id)){
                $user=User::where('id',$id)->first();
              }
              else{
                $id=Auth::user()->id;
                $user=User::where('id',$id)->first();
              }
              if(isset($month)){
                $from= new Carbon($month); 
                $from = $from->format('Y-m-d');
                $from= new Carbon($from); 
            
                $to=new Carbon($month);
                $to = $to->endOfMonth(); 
              
            }
              else{
                $from=Carbon::now()->firstOfMonth();
                $to=Carbon::now()->lastOfMonth();

              }

              $eteraryBalance=$user->etraryCalc($user->id,true);
          
            $leaveBalance=$user->leaveBalance;
            $counter=0;
            $oldCounter=0;
            $this_year= Carbon::now()->year;
            $last_year=Carbon::now()->subYears(1)->year;
           
            $first_day_of_last_year ='01-01-'.$last_year;
            $first_day_of_this_year ='01-01-'.$this_year;

            // $last_dayOf_last_year='01-01-'.$last_year; //?
            $today= Carbon::today();

            $start='01-01-'.$this_year;
            $start=new Carbon($start);
            $end = new Carbon('last day of december');
            $march='31-03-'.$this_year;
            $march=new Carbon($march);
            $april='01-04-'.$this_year;
            $april=new Carbon($april);

            $first_day_of_last_year=new Carbon($first_day_of_last_year);
            $first_day_of_this_year=new Carbon($first_day_of_this_year);
            $last_day_of_last_year=$first_day_of_this_year->subDays(1)->toDateString();
            $first_day_of_this_year=$first_day_of_this_year->toDateString();
            $from=$from->toDateString();
            $to=$to->toDateString();
            $employee_leave_last_year=Employee_leave::all()->where('user_id',$id)->where('title','اعتيادي')->whereBetween('start',[$first_day_of_last_year,$last_day_of_last_year])->whereBetween('end',[$first_day_of_last_year,$last_day_of_last_year]);
            $employee_leave_this_year=Employee_leave::all()->where('user_id',$id)->where('title','اعتيادي');
            foreach($employee_leave_last_year as $oldLeave){
            $endOldLeave=new Carbon($oldLeave->end );
            $startOldLeave=new Carbon($oldLeave->start);
            $oldCounter= $endOldLeave->diffInDays($startOldLeave);
            $oldCounter=$oldCounter+1;
            $oldCounter=$leaveBalance-$oldCounter;
            }
           if( $today >= $start && $today < $april){
            $leaveBalance=$oldCounter+$leaveBalance;
        }
           else {
            $leaveBalance=$leaveBalance;
                   }
            foreach($employee_leave_this_year as $thisLeave){
                if( $thisLeave->start >= $from && $thisLeave->end <= $to){
                    // dd($thisLeave->start,$thisLeave->end);

                $endLeave=new Carbon($thisLeave->end );
                $startLeave=new Carbon($thisLeave->start);
                $noDayes=$endLeave->diffInDays($startLeave);
                $noDayes=$noDayes+1;
                $counter=$counter+$noDayes;
            } // from to in the same month 
            else if ( ($thisLeave->start >= $from) && ($thisLeave->start <= $to)  && ($thisLeave->end > $to)){

                    $endLeave=new Carbon($to );
                    $startLeave=new Carbon($thisLeave->start);

                $noDayes=$endLeave->diffInDays($startLeave);
                $noDayes=$noDayes+1;
                $counter=$counter+$noDayes;
              

            }
            else if(($thisLeave->start < $from )&& ($thisLeave->end <= $to) && ($thisLeave->end >= $from)){
                $startLeave=new Carbon($from);
                $endLeave=new Carbon($thisLeave->end );
                $noDayes=$endLeave->diffInDays($startLeave);
                $noDayes=$noDayes+1;
                $counter=$counter+$noDayes;

            }
            // echo "<br>".$thisLeave->start." , ".$thisLeave->end." = ". $noDayes." , total: ".  $counter."<br>";
         
                
            }//end foreach

           if($number){
            $leaveBalance=$leaveBalance - $counter;
            $leaveBalance= $leaveBalance-$eteraryBalance;
            return $leaveBalance;
           }
           else{
            $leaveBalance=$leaveBalance - $counter;
            $leaveBalance= $leaveBalance-$eteraryBalance;
           return $leaveBalance. " يوم";
           }
        }

        public function etraryCalc($id=null,$number=false,$advance=false){

            if(isset($id)){
                $id=$id;
            }
            else{
                $id=Auth::user()->id;
            }
            $this_year=Carbon::now()->year;
            $start = new Carbon('first day of january');
            // $start=$start->toDateString();

            $end = new Carbon('last day of december');
            // $end=$end->toDateString();
            $leaveEtrary =Employee_leave::all()->where('title','اضطراري')->where('user_id',$id);
            $total=0;
            $totalCounter=0;
           
            if($leaveEtrary!=null){
            foreach( $leaveEtrary as $leave){
                $counter=0;
            $leavStart=$leave->start;
            $leavStart=new carbon($leavStart);

            $leaveEnds=$leave->end;
            $leaveEnds=new carbon($leaveEnds);
            
if( $leave->start >= $start && $leave->end <= $end){
    $noDayes=$leaveEnds->diffInDays($leavStart)+1;
    $counter++;
}

            //   if($leave->start >= $start && $leave->end <= $end){//case one 
            //     $noDayes=$leaveEnds->diffInDays($leavStart)+1;
            //     echo "1 <br>";
            // }


              else if(($leave->start >= $start && $leave->start <= $end)  && $leave->end > $end){ //case 2
                $leaveEnds=new Carbon('last day of december');
                $noDayes=$leaveEnds->diffInDays($leavStart)+1;
                $counter++;

                         }

                    

              else if(($leave->end >= $start || $leave->end <= $end) && $leave->start < $start){
                $start=new carbon($start);
              $leavStart=$start;
              $noDayes=$leaveEnds->diffInDays($leavStart)+1;
              $counter++;
            //   dd( $noDayes,$leave->start,$leave->end,$leave->id);

                          }
            $total=$total+$noDayes;
            $totalCounter=$totalCounter+$counter;
           
        }//end foreach

    }//end if not null
    if($number=true){
        return $total;
    }
    else if($number=true && $advance=true){
      
            return compact ('total','totalCounter');
    
    }
    else{
        return $total. ' ايام';
    }
      
        }





}
