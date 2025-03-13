<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function program() {
        return $this->belongsTo(Program::class, 'programs_id');
    }

    public function tertiarysectionclass() {
        return $this->belongsToMany(ClassTimeSlot::class);
    }
}
