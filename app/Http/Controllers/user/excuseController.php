<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\excuse;

use App\Models\Shift;
use Validator;

use \Carbon\CarbonPeriod;


use Illuminate\Support\Facades\Auth;

class excuseController extends Controller
{

    public function excuses_form(){

        return view('user.excuses');
      }
      
      //stor excuses !!
       public function excuses(Request $request){
        
        //   $request->validate([
        //     'from' => 'required|time',
        //     'to' => 'required|time',
        //     'date'=>'requierd|date',
        //     'reason'=>'requierd|string',
        // ]);
                
      // handel error of not enter the reason field !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
          $user=auth()->user()->id;
            //check if exceeds 6 hours !
            $start = new Carbon('first day of this month');
            $ends = new Carbon('last day of this month');

          $excuses=excuse::all()->where('user_id',$user)->whereBetween('date',[$start,$ends]);
          $total=0;
                foreach ($excuses as $excuse){
                   
                    $divrents=0;
                    $timeEnds=Carbon::parse($excuse->date.' '.$excuse->to);
                    $timeStarts=Carbon::parse($excuse->date.' '.$excuse->from);
                    
                    $divrents=$timeEnds->diffInMinutes($timeStarts);

                    
                    if($divrents!=0){
                        $total=$total+$divrents;
                    }
                }
            
                  if ($total>=360){
                      //message
                    
                  alert()->error('لقد تجاوزت 6 ساعات استئذان خلال الشهر')->persistent('Close')->autoclose(4000);
                return back();
                }

                if($total<360){
                    
                    // $from=Carbon::parse($excuse->date.' '.$request->get('from'));
                    // $to=Carbon::parse($excuse->date.' '.$request->get('to'));
                    $From=$request->get('from');
                    $To=$request->get('to');
                    $Date=$request->get('date');

                    $from=Carbon::parse($Date.' '.$From);
                     $to=Carbon::parse($Date.' '.$To);

                    $period=$to->diffInMinutes($from);
                    $totalDauration=$period+$total;
                    if($totalDauration<=360){
                        $excuse = new excuse([
                                        'user_id' => auth()->user()->id,
                                        'from' => $request->get('from'),
                                        'to' => $request->get('to'),
                                        'date' => $request->get('date'),
                                        'reason' => $request->get('reason'),
                                    
                                    ]);       
                                    $excuse->save();
                                            return redirect('/home')->with('success', 'تم إضافة الموظف بنجاح');  
                            
                        
                    }
                    else{
                        alert()->error('فترة الاستئذان المدخلة تجاوزت الفترة المتبقة لك من الاستئذانات')->persistent('Close')->autoclose(4000);
                        return back();
                    }
                }

                // //have 4 houre enter 2 or more !
                //   elseif($total==240){
                //     alert()->info(' طلب الاستئذان المدخل سوف يتطلب ساعات تعويضية')->persistent('Close')
                //     ->autoclose(4000);
                 
                //    $from=Carbon::parse($excuse->date.' '.$request->get('from'));
                //    $to=Carbon::parse($excuse->date.' '.$request->get('to'));
                   
                //    $period=$to->diffInMinutes($from);
             
                  
                //    if($period > 120){
                //     alert()->warning('تبقى لك فقط ساعتين استئذان خلال الشهر')->persistent('Close')->autoclose(4000);
                //     return back();

                //    }
                //    elseif($period <= 120){
                //     $excuse = new excuse([
                //         'user_id' => auth()->user()->id,
                //         'from' => $request->get('from'),
                //         'to' => $request->get('to'),
                //         'date' => $request->get('date'),
                //         'reason' => $request->get('reason'),
                      
                //     ]);       
                //     $excuse->save();
                //             return redirect('/home')->with('success', 'تم إضافة الموظف بنجاح');  
                //    }

                    
                // }

                //   elseif($total<=240){
                //       //add
                //       $excuse = new excuse([
                //         'user_id' => auth()->user()->id,
                //         'from' => $request->get('from'),
                //         'to' => $request->get('to'),
                //         'date' => $request->get('date'),
                //         'reason' => $request->get('reason'),
                      
                //     ]);       
                //     $excuse->save();
                //             return redirect('/home')->with('success', 'تم إضافة الموظف بنجاح');  
                //   }
           
       }
//moved to user model
            //  public function excusesCounter(){
            //     $user=Auth::user()->id;
            //     //current month
                
            //     $excuse=excuse::where('user_id',$user)->count();
               
            //     return  $excuse;
            //  }
//moved to user model
            //  public function excusesHours(){ 
            //     $user=Auth::user()->id;
            //     $total=0;
            //     //current month
            //     $excuses=excuse::all()->where('user_id',$user);
               
            //     foreach ($excuses as $excuse){
                   
            //         $divrents=0;
            //         $timeEnds=Carbon::parse($excuse->date.' '.$excuse->to);
            //         $timeStarts=Carbon::parse($excuse->date.' '.$excuse->from);
                    
            //         $divrents=$timeEnds->diffInMinutes($timeStarts);

                    
            //         if($divrents!=0){
            //             $total=$total+$divrents;
            //         }
            //     }
            //     dd($total/60); // stoped hear
            //     return $total;
            //  }



}