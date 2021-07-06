<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\excuse;
use App\Models\Shift;
use App\Models\Employee_leave;

use Validator;

use \Carbon\CarbonPeriod;


use Illuminate\Support\Facades\Auth;

class infoController extends Controller
{
    //
    public function userInfo(){
     
        //$id= auth()->user()->id;
        $user= auth()->user();
      
        
                // list of last 6 months
                $this_month = new Carbon('first day of this month');
                $to = new Carbon('last day of this month');
                //$posts=Post::all()->where('user_id',$user->id);
                $posts=Post::all()->where('user_id',$user->id)->whereBetween('date',[$this_month,$to]);

                $months[] = $this_month->format('M Y'); 
                $num_of_months = 6;
                for($i=1;$i <= $num_of_months; $i++){
                    $this_month->subMonth();
                    $months[] = $this_month->format('M Y');  
                }
                
                $monthselected = request('month');
                $from= new Carbon($monthselected); 
                $to=\Carbon\Carbon::parse($from)->endOfMonth();
                $postsFilter=Post::all()->where('user_id',$user->id)->whereBetween('date',[$from,$to]);

  //-----------------------------------------calculate anuall leave-----------------------------

                
        return view('user/information',compact('user','posts','months','postsFilter'));
    }

    

}
