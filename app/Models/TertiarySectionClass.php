<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TertiarySectionClass extends Model
{
    use HasFactory;

    public function teacher() {
        return $this->hasOne(Teacher::class);
    }

    public function course() {
        return $this->hasOne(Course::class);
    }

    public function room() {
        return $this->hasOne(Room::class);
    }

    public function tertiarysection() {
        return $this->belongsToMany(TertiarySection::class);
    }
}
