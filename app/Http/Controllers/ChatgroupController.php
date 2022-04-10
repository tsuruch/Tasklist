<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chatgroup;
use App\Models\Chatmanage;
use App\Models\Chat;

class ChatgroupController extends Controller
{
    function index() {
        $chatgroups = Chatmanage::where('user_id', session('user_id'))->get();
        return view('chats.index')
                ->with(['chatgroups'=>$chatgroups]);
    }

    public function create() {
        $users = User::where('id', '!=', session('user_id'))->get();
        return view('chats.create')
                ->with(['users'=>$users]);
    }

    function store(Request $request) {
        $chatgroup = new Chatgroup();
        $chatgroup->name = $request->name;
        $chatgroup->save();
        $group_id = Chatgroup::where('name', $request->name)->value('id');

        $manages = [];
        $members = $request->members;
        $members[] = session('user_id');
        foreach ($members as $member) {
            $record = [];
            $record['user_id'] = $member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }

        Chatmanage::insert($manages);

        return redirect()->route('chatgroups.index');
    }


    public function show($group_id) {
        $chatgroup = Chatgroup::find($group_id);
        $chatgroup_tousers = Chatgroup::where('id', $group_id)->with(['chatmanages.user'])->get();
        $chats = Chat::where('group_id', $chatgroup->id)->get();
        return view('chats.show')
                ->with(['chats'=> $chats, 'chatgroup'=>$chatgroup, 'chatgroup_tousers'=>$chatgroup_tousers]);
    }
}
