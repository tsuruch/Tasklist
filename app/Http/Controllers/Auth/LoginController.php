<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\Resettoken;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\PasswordresetRequest;
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

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request) {

        $this->validateLogin($request);

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
        $message = 1;
        return view('login')->with(['message'=>1]);
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


    public function passwordforgotform () {
        return view('passwordforgot');
    }


    public function forgotemail (ForgotRequest $request) {
        $user = User::where('email', $request->email)->first();
        $resettoken = new Resettoken();
        $resettoken->user_id = $user->id;
        $resettoken->reset_token = Str::random(60);
        $resettoken->auth_code = str_pad(random_int(0, 999999), 6, 0, STR_PAD_LEFT);
        $resettoken->save();

        $url = URL::SignedRoute('passwordreset', ['resettoken'=>$resettoken->reset_token]);

        Mail::send('emails.passwordreset', ['url' => $url], function($message){
            $message->to('coloswitch@gmail.com', 'Test')
            ->subject('パスワードリセット用メール');
        });
        $message = ['main'=>'メールを送信しました',
                    'sub'=>'メールを開き、認証コード['.$resettoken->auth_code.']と新しいパスワードを入力してください'];

        return view('forgotemail')
                    ->with(['message'=>$message]);
    }



    public function passwordreset(Request $request, $resettoken) {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $record = Resettoken::where('reset_token', $resettoken)->first();

        if($record->created_at->addHours(2) < now()) {
            $message= ['main'=>'有効期限が切れています',
                        'sub'=>'再度メールを送信してください'];
            return view('forgotemail')
            ->with(['message'=>$message]);
        }else{
            return view('passwordreset')
                        ->with(['record'=>$record]);
        }

    }

    public function passwordresetvalidate(PasswordresetRequest $request)    {
        $record = Resettoken::find($request->id);

        if((string) $record->auth_code === (string) $request->auth_code) {
            $user = User::find($record->user_id);
            $user->password = bcrypt($request->password);
            $user->save();
            $message= ['main'=>'パスワードを変更しました',
            'sub'=>'ログイン画面に戻り、ログインをしてください'];
        }else{
            $message= ['main'=>'正しくない認証コードです',
            'sub'=>'正しい認証コードを入力するか、もしくは再度メールを送信してください'];
        }

        return view('forgotemail')
        ->with(['message'=>$message]);
    }
}
