<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resettoken extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'reset_token',
        'auth_code',
        'created_at',
    ];
}
