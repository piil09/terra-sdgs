<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'status',
        'description',
        'date',
        'time',
        'location',
        'quota',
        'registered_count',
        'image',
    ];
}
