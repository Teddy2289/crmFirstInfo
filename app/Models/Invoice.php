<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['contract_id', 'payement_id', 'date', 'month', 'year', 'number', 'day_count', 'note', 'montant_ht', 'montant_ttc', 'date_sent', 'date_paid'];
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function statusPayement()
    {
        return $this->belongsTo(Payement::class, 'payement_id', 'id');
    }

    protected function getVatAttribute()
    {
        return (float)($this->montant_ttc - $this->montant_ht);
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}
