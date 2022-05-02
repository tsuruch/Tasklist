<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatmanage;
use App\Models\Notification;
use App\Models\Chatnotification;
use App\Models\Chatgroup;

class ChatmanageController extends Controller
{
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public static function add($group_id, $members, $create_id){
        $manages = [];
        $members[] = $create_id;
        $group_name = Chatgroup::where('id', $group_id)->value('name');
        foreach ($members as $member) {
            $record = [];
            $record['user_id'] = $member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }
        Chatmanage::insert($manages);

        foreach ($members as $member) {
            $notification = new Chatnotification();
            $notification->user_id = $member;
            $notification->group_id = $group_id;
            $notification->table_name = 'chatgroups';
            $notification->message = 'チャットグループ:'.$group_name.'に追加されました';
            $notification->route = 'chatgroups.show';
            $notification->save();
        }
    }

    public static function update($group_id, $members, $create_id){
        $before_members = Chatmanage::where('group_id', $group_id)->pluck('user_id')->toArray();
        $manages = [];
        $members[] = $create_id;
        /*追加する差分=array_diff($members, $moto)
          消す差分=array_diff($moto, $members)
        dd($moto, $members, array_diff($moto, $members), array_diff($members, $moto));*/
        $add_members = array_diff($members, $before_members);
        $del_members = array_diff($before_members, $members);
        $group_name = Chatgroup::where('id', $group_id)->value('name');
        foreach ($add_members as $add_member) {
            $record = [];
            $record['user_id'] = $add_member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }
        Chatmanage::insert($manages);
        foreach ($del_members as $del_member) {
            ChatManage::where('user_id', $del_member)->delete();
        }

        foreach ($add_members as $add_member) {
            $notification = new Chatnotification();
            $notification->user_id = $add_member;
            $notification->group_id = $group_id;
            $notification->table_name = 'chatgroups';
            $notification->message = 'チャットグループ:'.$group_name.'に追加されました';
            $notification->route = 'chatgroups.show';
            $notification->save();
        }

    }

}
