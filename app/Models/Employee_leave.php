<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_leave extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'title',
      'start',
      'end',
      'file_name',
      'file_path',
      'approved'
    ];

    protected $table="employee_leaves";

    public function user(){
        return $this->belongsTo(User::class);
    }


    
}
