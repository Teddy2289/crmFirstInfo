<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Conge extends Model
{
    use HasFactory;

    protected $table = 'conges';

  
    protected $fillable = [
        'employe_id',
        'start_date',
        'end_date',
        'type',
        'status',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employe_id');
    }

   
}

