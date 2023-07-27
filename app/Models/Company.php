<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name','trade_name','town', 'email', 'phone', 'address', 'postal_code', 'capital', 'siren', 'siret', 'ape', 'rcs', 'num_vat', 'iban', 'bic'];

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequested::class, 'company_id');
    }
}
