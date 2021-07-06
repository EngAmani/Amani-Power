<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'time_in',
      'time_out',
      'date'
    ];

    protected $table="posts";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function isLate($number=false){

     $today_shifts = Shift::where('end_date','>=',Carbon::today())->get();
      
    foreach($today_shifts as $shift){

      $shift_start = Carbon::parse(Carbon::today()->format('Y-m-d') . ' ' . $shift->from);
      $user_start = Carbon::parse(Carbon::today()->format('Y-m-d') . ' ' . $this->time_in);


      //dd($shift_start , $user_start);
    
      if($shift_start < $user_start){
       return true;
      }
  
    //  dd($shift_start > $user_start);
     // dd(Carbon::today(),$this->time_in,$shift->users->where('id',$this->user->id)->count());
    
    }
    return false;
      //dd($this); 
    }
}
