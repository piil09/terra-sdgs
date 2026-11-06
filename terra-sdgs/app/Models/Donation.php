<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'program_id',
        'program_name',
        'amount',
        'donor_name',
        'donor_email',
        'donor_phone',
        'message',
        'payment_method',
        'status',
    ];
}
