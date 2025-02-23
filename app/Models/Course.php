<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function tertiarysectionclass() {
        return $this->hasMany(TertiarySectionClass::class, 'courses_id');
    }
}
