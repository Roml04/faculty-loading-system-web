<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_name',
        'level',
        'path'
    ];

    public function section() {
        return $this->hasMany(Section::class, 'programs_id');
    }
}