<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'quantity', 'price', 'fee','invoice_id'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected $casts = [
        'fee' => 'boolean',
    ];
}
