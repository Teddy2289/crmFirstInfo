<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;
    protected $fillale = ['label', 'employe_id', 'date_start', 'date_end'];

    public function employes(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }
}
