<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    protected $fillable = ['full_name', 'email', 'phone_number', 'date_of_birth'];

    //Calculates how old is user
    public function getAgeAttribute()
    {
        return \Carbon\Carbon::parse($this->date_of_birth)->age;
    }
}
