<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSnapshot extends Model
{
    protected $fillable = ['snapshot', 'device_id', 'current_term'];

    protected $casts = [
        'snapshot' => 'array'
    ];
}
