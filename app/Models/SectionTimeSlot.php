<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionTimeSlot extends Model
{
    public function section() {
        return $this->belongsToMany(Section::class);
    }

    public function classtimeslot() {
        return $this->belongsToMany(ClassTimeSlot::class);
    }
}
