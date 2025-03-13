<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTimeSlot extends Model
{
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function section() {
        return $this->belongsToMany(Section::class);
    }
}
