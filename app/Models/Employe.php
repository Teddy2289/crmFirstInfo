<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = ['phone_number', 'address', 'street_number', 'country_id', 'company_id', 'user_id', 'city', 'postal_code', 'birth_name', 'date_of_birth', 'birth_postal_code', 'birth_city', 'gender', 'nationality', 'social_security_number'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
