<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSnapshot extends Model
{
    protected $fillable = ['snapshot'];

    protected $casts = [
        'snapshot' => 'array'
    ];
}
