<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\UserinfoRequest;
use App\Http\Requests\PasswordRequest;

class UserController extends Controller
{
    public function update(UserinfoRequest $request) {
        $user = User::find(session('user_id'));
        $user->username = $request->username;
        $user->email = $request->email;

        $user->api_token = Str::random(60);
        $user->save();

        //sessionにトークンと名前保存する。名前は表示するため。トークンはログイン認証をするため。
        session(['api_token' => $user->api_token,
                'username' => $user->username,
                'user_id' => $user->id,
    ]);
        return back();
    }



    public function passwordupdate(PasswordRequest $request) {
        $user = User::find(session('user_id'));
        $user->password = bcrypt($request->password);

        $user->api_token = Str::random(60);
        $user->save();

        //sessionにトークンと名前保存する。名前は表示するため。トークンはログイン認証をするため。
        session(['api_token' => $user->api_token,
                'username' => $user->username,
                'user_id' => $user->id,
    ]);
        return back();

    }


}
