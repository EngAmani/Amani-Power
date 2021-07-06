<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class excuse extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'user_id',
        'to',
        'date',
        'reason'
      ];
  
      protected $table="excuses";
  
      public function user(){
          return $this->belongsTo(User::class);
      }


      
}
