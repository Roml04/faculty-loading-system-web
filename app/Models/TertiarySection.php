<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TertiarySection extends Model
{
    use HasFactory;

    public function program() {
        return $this->belongsTo(Program::class, 'programs_id');
    }

    public function tertiarysectionclass() {
        return $this->belongsToMany(TertiarySectionClass::class, 'tertiary_sections_id');
    }
}
