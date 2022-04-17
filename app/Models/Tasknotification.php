<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasknotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_name',
        'user_id',
        'task_id',
    ];
}
