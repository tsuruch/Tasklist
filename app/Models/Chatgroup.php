<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\DatabaseLogger;

class Chatgroup extends Model
{
    use HasFactory;
    use DatabaseLogger;

    protected $fillable = [
        'name',
        'user_id',
    ];



    public function chatmanages() {
        return $this->hasMany(Chatmanage::class, 'group_id');
    }

    public function chats() {
        return $this->hasMany(Chat::class, 'group_id');
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

}
