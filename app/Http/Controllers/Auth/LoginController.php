<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //
    public function loginform() {
        return view('login');
    }




    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']); //requestからemail,passwordだけ取ってくる。

        //attempt()でユーザを認証する。
        if(Auth::guard()->attempt($credentials)) {

            //ログインをする度にapi_tokenのアップデート
            $user_info = User::whereEmail($request->email)->first(); //userのメールアドレスの取得
            $user_id = $user_info->id;

            //usersテーブルから対象userを見つけてapi_tokenを再生成する。
            $user = User::find($user_id);
            $user->api_token = Str::random(60);
            $user->save();

            session(['api_token' => $user->api_token,
                    'username' => $user->username,
        ]);

            //loginが成功するとtokenと共に情報をjsonで返す。
            return redirect()->route('tasks.index');
        }

        return redirect()->route('users.loginform');
    }


    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('users.loginform');
    }
}
