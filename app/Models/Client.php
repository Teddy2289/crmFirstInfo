<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','address','postal_code','siret','rcs','country_id','tva'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
