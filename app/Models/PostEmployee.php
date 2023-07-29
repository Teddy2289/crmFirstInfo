<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','role','type_contrat','start_date','end_date','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
