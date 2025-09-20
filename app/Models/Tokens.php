<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    protected $fillable = ['plain_text_token', 'email','expires_at'];
}
