<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTimeSlot extends Model
{
    public function teachers() {
        return $this->belongsTo(Teacher::class);
    }

    public function courses() {
        return $this->belongsTo(Course::class, 'courses_id');
    }

    public function rooms() {
        return $this->belongsTo(Room::class);
    }

    public function sections() {
        return $this->belongsToMany(Section::class, 'section_time_slots', 'class_time_slots_id', 'sections_id');
    }
}
