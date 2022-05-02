<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        return back();
    }


}
