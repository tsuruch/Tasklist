<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatgroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];



    public function chatmanages() {
        return $this->hasMany(Chatmanage::class, 'group_id');
    }


}
