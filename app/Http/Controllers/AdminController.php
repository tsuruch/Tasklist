<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('authuser');
    }


    public function show() {
        $users = User::oldest()->get();
        return view('admin')
                ->with(['users'=>$users]);
    }

    public function update(Request $request, $user_id) {
        $admin = $request->what_admin;
        $user = User::find($user_id);
        if ($request->has($admin)) {
            $user->$admin = true;
            $user->save();
            $selfnotification = $user->username.'の権限を変更しました';
            session(['selfnotification'=>$selfnotification]);
            return back();
        } else {
            $user->$admin = false;
            $user->save();
            $selfnotification = $user->username.'の権限を変更しました';
            session(['selfnotification'=>$selfnotification]);
            return back();
        }

    }
}
