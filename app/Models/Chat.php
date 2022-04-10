<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'group_id',
        'chat',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function chatgroup() {
        return $this->belongsTo(Chatgroup::class, 'group_id');
    }

 }
