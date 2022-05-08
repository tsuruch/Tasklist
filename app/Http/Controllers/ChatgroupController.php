<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chatgroup;
use App\Models\Chatmanage;
use App\Models\Chat;
use App\Http\Requests\ChatgroupRequest;

class ChatgroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('authuser');
    }

    function index() {
        $chatgroups = Chatmanage::where('chatmanages.user_id', session('user_id'))->get();
        return view('chats.index')
                ->with(['chatgroups'=>$chatgroups]);
    }

    public function create() {
        $users = User::where('id', '!=', session('user_id'))->get();
        return view('chats.create')
                ->with(['users'=>$users]);
    }

    function store(ChatgroupRequest $request) {
        $chatgroup = new Chatgroup();
        $chatgroup->name = $request->name;
        $chatgroup->user_id = session('user_id');
        $chatgroup->save();
        $group_id = Chatgroup::where('name', $request->name)->value('id');

        $members = $request->members;
        $create_id = session('user_id');

        ChatmanageController::add($group_id, $members, $create_id);
        $selfnotification = 'チャットグループ：'.$chatgroup->name.'を作成しました';
        session(['selfnotification'=>$selfnotification]);
        return redirect()->route('chatgroups.index');
    }


    public function show($group_id) {
        $chatgroup = Chatgroup::find($group_id);
        $chatgroup_tousers = Chatgroup::where('id', $group_id)->with(['chatmanages.user'])->get();
        $chats = Chat::where('group_id', $chatgroup->id)->get();
        return view('chats.show')
                ->with(['chats'=> $chats, 'chatgroup'=>$chatgroup, 'chatgroup_tousers'=>$chatgroup_tousers]);
    }


    public function edit($group_id) {
        $in_users = [];
        foreach (Chatmanage::where('group_id', $group_id)->get() as $user) {
          $in_users[] = $user->user_id;
        }
        $all_users = User::where('id', '!=', session('user_id'))->get();
        $chatgroup = Chatgroup::find($group_id);
        return view('chats.edit')
                ->with(['in_users'=>$in_users, 'all_users'=>$all_users, 'chatgroup'=>$chatgroup]);
    }

    function update(ChatgroupRequest $request, $group_id) {
        $chatgroup = Chatgroup::find($group_id);
        $chatgroup->name = $request->name;
        $chatgroup->save();
        $group_id = Chatgroup::where('name', $request->name)->value('id');

        $members = $request->members;
        $create_id = session('user_id');


        ChatmanageController::update($group_id, $members, $create_id);

        $selfnotification = 'チャットグループ：'.$chatgroup->name.'を更新しました';
        session(['selfnotification'=>$selfnotification]);
        return redirect()->route('chatgroups.show', $group_id);
    }

    public function destroy ($group_id) {
        $chatgroup = Chatgroup::find($group_id);
        $chatgroup_name = $chatgroup->name;
        $chatgroup->delete();

        $selfnotification = 'チャットグループ：'.$chatgroup_name.'を削除しました';
        session(['selfnotification'=>$selfnotification]);
        return redirect()->route('chatgroups.index');
    }


}
