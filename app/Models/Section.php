<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = ['section_name', 'year', 'term', 'programs_id'];
    
    public function program() {
        return $this->belongsTo(Program::class, 'programs_id');
    }

    public function classtimeslot() {
        return $this->belongsToMany(ClassTimeSlot::class, 'section_time_slots', 'sections_id', 'class_time_slots_id');
    }
}
