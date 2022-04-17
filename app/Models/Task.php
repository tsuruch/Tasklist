<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\DatabaseLogger;

class Task extends Model
{
    use HasFactory;
    use DatabaseLogger;

    protected $fillable = [
        'name',
        'deadline',
    ];

    public function mytasks() {
        return $this->hasMany(Mytask::class, 'task_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


}
