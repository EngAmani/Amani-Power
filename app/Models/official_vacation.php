<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class official_vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title',
        'start',
        'end'
      ];
    protected $table="official_vacation";

   
}
