<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TertiarySection extends Model
{
    use HasFactory;

    public function program() {
        return $this->hasOne(Program::class);
    }

    public function tertiarysectionclass() {
        return $this->belongsToMany(TertiarySectionClass::class, 'tertiarysections_id');
    }
}
