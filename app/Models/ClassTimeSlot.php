<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTimeSlot extends Model
{
    public function teacher() {
        return $this->belongsTo(Teacher::class, 'teachers_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'courses_id');
    }

    public function room() {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function section() {
        return $this->belongsToMany(Section::class);
    }
}
