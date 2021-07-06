<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Employee_leave;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
              // $post = Post::Last();
            //  User::find(1)->shifts()->attach(1);
                // dd(auth()->user()->shifts);
    


                $id=Auth::user()->id;
                $today= Carbon::now()->toDateString();
                $posts=Post::all()->where('user_id',$id)->where('date',$today);



        return view('user.home',compact('posts'));
    }

    // public function popUp(){
    //   return view('admin/popUp');
    // }

    public function adminIndex(){
      $today=Carbon::today();
        $total_users = User::where('role',0)->count();
        $total_attend = Post::whereDate('created_at', Carbon::today())->distinct('user_id')->count();
        $attend =Post::whereDate('created_at', Carbon::today())->distinct('user_id')->get();//used for attend list
     
       $posts = Post::whereDate('created_at',Carbon::today())->get();
       $total_late = 0; 

      //  $from=new Carbon('first day of this month');
      $to = Carbon::now(); //returns current day
      $to = $to-> endOfMonth();   
          //  $LeaveChart=Employee_leave::whereBetween('start',[$from,$to])->orWhereBetween('end',[$from,$to])->get();
          $LeaveChart=Employee_leave::all();
          //->where('user_id',1)
           $users = User::all()->where('role',0);
        
           $sickDays=0;$e3tyadi=0;$eterary=0;$officalMetion=0;$deathLeave=0;$max=10;
           $selectedsickDays=0;$selectede3=0;$selectedeter=0;$selectedoff=0;$deathLeave=0;
           foreach($users as $us){
            $eteraryList[$us->id]=0;
            $sickDaysList[$us->id]=0;
            $e3tyadiList[$us->id]=0;
            $offList[$us->id]=0;
            $wafaaList[$us->id]=0;
            $namesList[$us->id]=$us->name;
            $total[$us->id]=0;

           }

           foreach($users as $usr){
            $sickDays=0;$e3tyadi=0;$eterary=0;$officalMetion=0;$deathLeave=0;$max=10;
            $LeaveChart=Employee_leave::all()->where('user_id',$usr->id);
            $counter=0;
             if($LeaveChart!=null){
           foreach($LeaveChart as $usrleave){
            $leavesContr=0;
           

          $from=new Carbon('first day of this month');
          $from=$from->toDateString();
          // $to=new Carbon('Today');

             $fEnds=new Carbon($usrleave->end);
             $fStart=new Carbon($usrleave->start);
             if( $fStart >= $from && $fEnds <= $to){
// dd($usrleave);
              $counter= $fEnds->diffInDays($fStart);
              $leavesContr= $counter+1;

              // $leavesContr= $leavesContr+$counter;
              // dd($counter,  $leavesContr);

              // echo "Case 1 : start: ".$fStart." Ends ".$fEnds." Counter: ".$counter." LeaveCounter: ".$leavesContr."<br>";
           }
             else if ( ($fStart >= $from && $fStart <= $to)  && $fEnds > $to){
               $fEnds = Carbon::now(); //returns current day
               $fEnds = $fEnds-> endOfMonth();   
               $counter= $fEnds->diffInDays($fStart);
               $leavesContr= $counter+1;
             
              //  $leavesContr= $leavesContr+$counter;

              //  echo "Case 2 : start: ".$fStart." Ends ".$fEnds." Counter: ".$counter." LeaveCounter: ".$leavesContr."<br>";

             }
             else if($fStart < $from && ($fEnds <= $to && $fEnds >= $from)){
              $fStart = Carbon::now(); //returns current day
              $fStart = $fStart->firstOfMonth();         
              $counter= $fEnds->diffInDays($fStart);
              $leavesContr= $counter+1;
              // $leavesContr= $leavesContr+$counter;
              // echo "Case 3 : start: ".$fStart." Ends ".$fEnds." Counter: ".$counter." LeaveCounter: ".$leavesContr."<br>";

             }              


                // $counter=$leavesContr;
             if($usrleave->title==='مرضي'){
             $selectedsickDays=$usrleave->user_id;
              $sickDays=$leavesContr+$sickDays;
              if($selectedsickDays==$usr->id){ 
                $sickDaysList[$selectedsickDays]=$sickDays;}
                // else if($usr->id>$selectedsickDays){
                //  $sickDaysList[$usr->id]=0;
                // }
             }
             elseif($usrleave->title === 'اعتيادي'){
              $selectede3=$usrleave->user_id;
              $e3tyadi=$leavesContr+$e3tyadi;
              if($selectede3==$usr->id){ 
                $e3tyadiList[$selectede3]=$e3tyadi;
              }

                // else if($usr->id>$selectede3){
                 
                //   $e3tyadiList[$usr->id]=0;
                // }
            }
            elseif($usrleave->title==='اضطراري'){
              $selectedeter=$usrleave->user_id;
              $eterary=$leavesContr+$eterary;
              if($selectedeter==$usr->id){ 
            
                $eteraryList[$selectedeter]=$eterary;}
                
                // elseif($usr->id>$selectedeter){
                //   $eteraryList[$usr->id]=0;
                  
                // }


            }
            elseif($usrleave->title=== 'مهمة رسمية'){
              $selectedoff=$usrleave->user_id;
              $officalMetion=$leavesContr+$officalMetion;
              if($selectedoff==$usr->id){ 
            
                $offList[$selectedoff]=$officalMetion;}
                
                // elseif($usr->id>$selectedoff){
                //   $offList[$usr->id]=0;
                  
                // }

            }
            elseif($usrleave->title=== 'وفاة'){
              $selectedewafa=$usrleave->user_id;
              $deathLeave=$leavesContr+$deathLeave;
              if($selectedewafa==$usr->id){ 
            
                $wafaaList[$selectedewafa]=$deathLeave;}
                
                // elseif($usr->id>$selectedewafa){
                //   $wafaaList[$usr->id]=0;
                  
                // }
            }
          }
                   

            $userF[$usr->id]['name']=$usr->name;
            $total[$usr->id]= $counter+ $total[$usr->id];
        }//test if not null
          }//end foreach users
// exit;

// dd( $usersLeavsLabels[0],$usersLeavsData);

       foreach( $posts as $post){
            if($post->isLate()){
                $total_late++;
            }
       }

       $now = Carbon::today()->firstOfMonth();
     
    //   $now->subMonth(1);
     //dd($now);
   
       $this_month=\Carbon\Carbon::now()->format('M Y');
       $LateNames=" ";
       $lateCalc=0;
       $LateMints=0;
       $lateCalc=array();
       $LateNames=array();
       $LateMints=array();
       $i=0;
       $today=$today->toDateString();
       $posToday=Post::all()->where('date',$today);
        foreach($users as $user){

          $absentList=$user->absentCalculator($user->id,$today,true);
          // dd($user->name);
         $latenes=$user->calc($user->id,$today,true);
        //  $absentList=$user->absentCalculator($user->id,$today,true); //develop absent calculator for attendanse !

          if( $absentList == 1){
            $absentsNames[]=$user->name;
          }
          else{
            $absentsNames[]=null;
          }
          if( $latenes > 0){ // this is like hhhheaaaal !!
            // $LateNames[]=$user->name; //here is a problem if someone late $LateNames[]=$user->name;
            // $lateCalc=$latenes;
         
            $LateNames [$user->id]=$user->name;
            $lateCalc[$user->id]=(int)($latenes/60);
            $LateMints[$user->id]=$latenes%60;
          }
          // else if( $latenes==0){
  
          //   $LateNames=array("لا يوجد تاخير اليوم");
          //   $lateCalc=0;
          // }
          
          $i++;
        }
       foreach($users as $user){
           if($user->calc($user->id, $this_month,true) > 0){
           $late_users[$user->id]['name'] = $user->name;
           $late_users[$user->id]['late'] = round($user->calc($user->id, $this_month,true)/60);
           $totals[$user->id] = $user->calc($user->id, $this_month,true);
           }// elses handel the setiwation if no one did late !
           else{
             $late_users[$user->id]['name'] =$user->name;
             $late_users[$user->id]['late'] = 0;
             $totals[$user->id] = $user->calc($user->id, $this_month,true);
           }
       }

   
       array_multisort($totals, SORT_DESC,$late_users); //mirecal !you should understand it !

      $max_limit = 10;
        for($i=0;$i < count($late_users);$i++){
           if($i < $max_limit){
          $labels_late[]=$late_users[$i]['name'];
          $data_late[]=$late_users[$i]['late'];
           }
        }
        $data_late=$data_late;
      $data_late = implode(',',$data_late);

      foreach($users as $user){
        // dd($user->absentCalculator(1, $this_month));
        if($user->absentCalculator($user->id, $this_month,true) > 0){
        $absent_users[$user->id]['name'] = $user->name;
        $absent_users[$user->id]['absent'] = $user->absentCalculator($user->id,$this_month,true);
        $totalAbs[$user->id] = $user->absentCalculator($user->id, $this_month,true);
        }
        else{
        
          $late_users[$user->id]['name'] = $user->name;
          $late_users[$user->id]['late'] = 0;
          $totals[$user->id] = $user->calc($user->id, $this_month,true);
        }
    }
    
         array_multisort($totalAbs, SORT_DESC,$absent_users);

//    krsort($absent_users);

   $max_limit = 10;
     for($i=0;$i < count($absent_users);$i++){
        if($i < $max_limit){
       $labels_absent[]=$absent_users[$i]['name'];
       $data_absent[]=$absent_users[$i]['absent'];
        }
     }
    //  dd($LateNames,$posToday,$lateCalc);


       return view('admin.adminhome',compact('today','users','LateMints','posToday','total_users','data_absent','labels_absent','total_attend','total_late','data_late','labels_late','attend','absentsNames','LateNames','lateCalc','namesList','sickDaysList','eteraryList','e3tyadiList','offList','wafaaList'));
    }

}
