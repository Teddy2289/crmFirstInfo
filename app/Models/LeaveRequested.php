<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequested extends Model
{
    use HasFactory;
    protected $fillable = ['employe_id','leave_type_id','compagny_id','Leave_reason','start_date','end_date','statut'];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    // Relation avec le type de congé (LeaveRequested appartient à un TypeConge)
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    // Relation avec la compagnie (LeaveRequested appartient à une Compagnie)
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
