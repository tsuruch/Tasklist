<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deadline',
    ];

    public function mytask() {
        return $this->hasMany(myTask::class);
    }


}
