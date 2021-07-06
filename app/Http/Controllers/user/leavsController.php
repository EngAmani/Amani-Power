<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee_leave;
use Carbon\Carbon;



class leavsController extends Controller
{
    //


    public function index(){
        return view('user/leaves');
    }

    public function fileUpload(Request $req){
        $req->validate([
        'file' => 'mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);
         
        if($req->get('title')=="اضطراري"){
            //نجيب كل الاجازات الاضطرارية للشخص خلال السنة ونحسب الايام اذا اكثر من 5 نرفض 
            $id=auth()->user()->id;
            $this_year= Carbon::now()->year;
            $start = new Carbon('first day of january');
            // $start=$start->toDateString();

            $end = new Carbon('last day of december');
            // $end=$end->toDateString();
            $leaveEtrary =Employee_leave::all()->where('title','اضطراري')->where('user_id',$id);
            $total=0;
            if($leaveEtrary!=null){
            foreach( $leaveEtrary as $leave){
            $leavStart=$leave->start;
            $leavStart=new carbon($leavStart);

            $leaveEnds=$leave->end;
            $leaveEnds=new carbon($leaveEnds);
            
if( $leave->start >= $start && $leave->end <= $end){
    $noDayes=$leaveEnds->diffInDays($leavStart)+1;
}

            //   if($leave->start >= $start && $leave->end <= $end){//case one 
            //     $noDayes=$leaveEnds->diffInDays($leavStart)+1;
            //     echo "1 <br>";
            // }


              else if(($leave->start >= $start && $leave->start <= $end)  && $leave->end > $end){ //case 2
                $leaveEnds=new Carbon('last day of december');
                $noDayes=$leaveEnds->diffInDays($leavStart)+1;

                         }

                    

              else if(($leave->end >= $start && $leave->end <= $end) && $leave->start < $start){ //And not OR
                $start=new carbon($start);
              $leavStart=$start;
              $noDayes=$leaveEnds->diffInDays($leavStart)+1;
            //   dd( $noDayes,$leave->start,$leave->end,$leave->id);

                          }
            $total=$total+$noDayes;
           
        }//end foreach

    }//end if not null
}
  
        $fileModel = new Employee_leave([
            'user_id' => auth()->user()->id,
            'title' => $req->get('title'),
            'start' => $req->get('start'),
            'end' => $req->get('end'),
           
        
        ]);       
      
                // return redirect('/home')->with('success', 'تم إضافة الموظف بنجاح');

        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->file_name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
            ->with('success','تم إرفاق الملف بنجاح') //last fot ever !!!!
            ->with('file', $fileName);
        }
     
        else if($req->get('title') == 'اضطراري' && $total >= 5){


            return back()
            ->with('error',"لقد تجاوزت العدد المسموح من الإجازات الإضطرارية");
        }
        else {
            $fileModel->save();

            return back()
            ->with('success','تم الإرسال بنجاح');
        }
   }
   
}
