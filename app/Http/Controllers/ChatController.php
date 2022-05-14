<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\MyEvent;
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public function add(Request $request, $group_id) {
        $chat = new Chat();
        $chat->user_id = session('user_id');
        $chat->group_id = $group_id;
        $chat->chat = $request->chat;
        $chat->save();
        $push_chat = ['username'=>$chat->user->username, 'created_at'=>$chat->created_at->toDateTimeString(), 'chat'=>nl2br(e($chat->chat))];
        event(new MyEvent($push_chat));
        return back();
    }


}
