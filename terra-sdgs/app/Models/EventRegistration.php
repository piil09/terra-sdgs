<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'city',
        'occupation',
        'gender',
        'interest',
        'volunteer_experience',
    ];
}
