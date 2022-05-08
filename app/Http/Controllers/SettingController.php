<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usersetting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public function show() {
        $user = User::find(session('user_id'));
        $usersetting = $user->usersetting;
        return view('setting')->with(['user'=>$user, 'usersetting'=>$usersetting]);
    }

    public function usersettingupdate(Request $request){
        $usersetting = User::find(session('user_id'))->usersetting;
        $notifies = $request->notifies;
        $usersetting->commentnotify = false;
        $usersetting->chatnotify = false;
        $usersetting->tasknotify = false;
        $usersetting->chatgroupnotify = false;
        foreach ((array)$notifies as $notify) {
            switch ($notify) {
                case 'commentnotify':
                    $usersetting->commentnotify = true;

                    break;

                case 'chatnotify':
                    $usersetting->chatnotify = true;
                    break;

                case 'tasknotify':
                    $usersetting->tasknotify = true;
                    break;

                case 'chatgroupnotify':
                    $usersetting->chatgroupnotify = true;
                    break;

            }
        }

        $usersetting->onecomment = $request->onecomment;
        $usersetting->save();

        $selfnotification = 'その他の設定を更新しました';
        session(['selfnotification'=>$selfnotification]);
        return back();
    }

    public static function create($user_id) {
        $usersetting = new Usersetting();
        $usersetting->user_id = $user_id;
        $usersetting->save();
    }
}
