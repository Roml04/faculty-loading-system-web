<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionTimeSlot extends Model
{

    protected $fillable = ['sections_id', 'class_time_slots_id'];

    public function section() {
        return $this->belongsToMany(Section::class);
    }

    public function classtimeslot() {
        return $this->belongsToMany(ClassTimeSlot::class);
    }
}
