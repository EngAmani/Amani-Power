<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift; 
use App\Models\User; 

class ShiftController extends Controller
{
    public function add(){
        return view('admin.shifts.add');
    }

    public function store(){
        
        $shift = new Shift();
        $shift->title = request('title');
        $shift->from = request('from');
        $shift->to = request('to');
        $shift->start_date = request('start_date');
        $shift->end_date = request('end_date');
        $shift->save();
        return redirect()->route('shift',$shift->id)->withMessage('done');
        //dd(request()->all());
    }

    public function shift($id){
      $shift = Shift::find($id);
     // dd($shift->users);
       return view('admin.shifts.shift',compact('shift'));
    }

    public function unassign($id,$shiftid){
        $user = User::find($id);

        $user->shifts()->detach($shiftid);

        return redirect()->route('shift',$shiftid);
    }

    public function userToShift(){
        $shifts=Shift::all();
        $users=User::all()->where('role','0');
      
        return view('admin.shifts.userShift',compact('shifts','users'));
    }

    public function storeShiftUser(Request $request){
    
        $shift=$request->input('shifts');
        
        if(isset($_POST['save_multiple_checkbox'])){

            if(isset($_POST['all'])){
                
                $users=User::all()->where('role',0);
                foreach($users as $user){
                    $user_shift=$user->shifts;
                    if($user_shift->isEmpty()){
                        $user->shifts()->attach($shift);
                    }
                    else{
                        alert()->error($user->name.' لديه فترة مسجلة في حال التغيير يرجى حذفها اولاً ')->persistent('Close')->autoclose(4000);
        
                        return back();
                    }
                    
                }//end foreach
                alert()->success('تم إضافة الكل')->persistent('Close')->autoclose(4000);
                return back();
            
           }

           else{
           
           $users=$_POST['user'];

           foreach($users as $id){ //users and is is user id number !
            
            $user = User::find($id);
            $user_shift=$user->shifts;
        
            if ( $user_shift->isEmpty()) {   
               
           $user->shifts()->attach($shift);

           alert()->success('تم إضافة '.$user->name.' للفترة')->persistent('Close')->autoclose(4000);
           return back();
            }
            else{
                alert()->error($user->name.' لديه فترة مسجلة في حال التغيير يرجى حذفها اولاً ')->persistent('Close')->autoclose(4000);

                return back();
            }
           
             }//end foreach
            }//end if not all
        }//end if button 

      //  $user_shift->save();
    }//end function


    public function deleteShift(){

        $users=User::all()->where('role',0);
        $shifts=Shift::all();
                foreach($users as $user){
                    $user_shift=$user->shifts;
                    
                        $user->shifts()->detach();
                }     
                alert()->success('تم حذف الفترة للكل')->persistent('Close')->autoclose(4000);
                return back();
    }


    public function shiftTable(){
        $users=User::all()->where('role',0);
        $shifts=Shift::all(); //shit info
        $user=User::all()->where('id',5);
       
//   foreach( $user->shifts as $z){
//       $name=$z->name;
//       $id=$z->id
//     //  $shiftid=Shift::where->()
//       //$title=
     
//   }

        
        return view('admin.shifts.table',compact('users','shifts'));
    }


    public function deleteShiftForEmployee($id){
        $user = User::find($id);
        $user->shifts()->detach();
 
        
       alert()->success('تم الحذف بنجاح')->persistent('Close')->autoclose(4000);
       return back();

    }
}
