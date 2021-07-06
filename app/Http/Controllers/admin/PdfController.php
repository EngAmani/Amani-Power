<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Post; 

use PDF;
use Carbon\Carbon;

class PdfController extends Controller
{
    //

    public function index(){
        $users=User::all()->where('role',0);
        
        // list of last 6 months
        $this_month = new Carbon('first day of this month');
        $months[] = $this_month->format('M Y'); 
        $num_of_months = 12;
        for($i=1;$i <= $num_of_months; $i++){
            $this_month->subMonth();
            $months[] = $this_month->format('M Y');  
        }
        
 
        return view ('admin/pdf',compact('users','months'));
    }

    public function generatPDF(Request $request){
        
        $user_id=$request->get('user');
        $userinfo=User::all()->where('id',$user_id)->first();
        $monthAr=request('month');
        $monthStart=new carbon($monthAr);
        $monthEnd=\Carbon\Carbon::parse($monthStart)->endOfMonth();
        $posts=Post::all()->where('user_id',$user_id)->whereBetween('date',[$monthStart,$monthEnd]);
        $users=User::all()->where('role',0);
        $shiftStart='08:10:00';
       $shiftEnd='16:00:00';
        foreach($userinfo->shifts as $ush){
            $shiftStart=$ush->from;
            $shiftEnd=$ush->to;
           
        }
        
      


        $data = [
            'month' => request('month'),
			'userinfo' => $userinfo, // but all data u want to use in pdf, absent, late ...etc
            'posts'=>$posts,
            'users'=>$users,
            'shiftStart'=>$shiftStart,
            'shiftEnd'=>$shiftEnd,
		];






       
        if (strpos($monthAr, 'Jan') !== false){
        $monthAr="يناير";
        }
        else if (strpos($monthAr, 'Feb') !== false){
            $monthAr="فبراير";
            }
            else if (strpos($monthAr, 'Mar') !== false){
                $monthAr="مارس";
                }
                else if (strpos($monthAr, 'Apr') !== false){
                    $monthAr="أبريل";
                    }
                    else if (strpos($monthAr, 'May') !== false){
                        $monthAr="مايو";
                        }
                        else if (strpos($monthAr, 'Jun') !== false){
                            $monthAr="يونيو";
                            }
                            else if (strpos($monthAr, 'Jul') !== false){
                                $monthAr="يوليو";
                                }
                                else if (strpos($monthAr, 'Aug') !== false){
                                    $monthAr="أغسطس";
                                    }
                                    else if (strpos($monthAr, 'Sep') !== false){
                                        $monthAr="سبتمبر";
                                        }
                                        else if (strpos($monthAr, 'Oct') !== false){
                                            $monthAr="أكتوبر";
                                            }
                                            else if (strpos($monthAr, 'Nov') !== false){
                                                $monthAr="نوفمبر";
                                                }
                                                else if (strpos($monthAr, 'Dec') !== false){
                                                    $monthAr="ديسمبر";
                                                    } 

                                                    $now = Carbon::now();
                                                    $monthAr=$monthAr." ".$now->year;
                                                 
		$pdf = PDF::loadView('pdf.index', $data, compact('monthAr'));
        $pdf->autoScriptToLang = true;
        $pdf->autoArabic = true;
        $pdf->autoLangToFont = true;
    
		return $pdf->stream('nb.pdf');

    }
}
