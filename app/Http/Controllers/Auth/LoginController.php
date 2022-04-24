<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Http\Controllers\SettingController;
use Database\Seeders\UserSettingSeeder;

class LoginController extends Controller
{
    //
    public function loginform() {
        return view('login');
    }

    public function signupform() {
        return view('signup');
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

            //sessionにトークンと名前保存する。名前は表示するため。トークンはログイン認証をするため。
            session(['api_token' => $user->api_token,
                    'username' => $user->username,
                    'user_id' => $user->id,
        ]);

            return redirect()->route('tasks.index');
        }

        return redirect()->route('users.loginform');
    }


    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('users.loginform');
    }

    public function signup(UserRequest $request) {
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = false;
        $user->api_token = Str::random(60);
        $user->save();


        session(['api_token' => $user->api_token,
        'username' => $user->username,
        'user_id' => $user->id,
    ]);

    SettingController::create($user->id);

    return redirect()->route('tasks.index');

    }

}
