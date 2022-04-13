<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatmanage;

class ChatmanageController extends Controller
{
    public static function add($group_id, $members, $create_id){
        $manages = [];
        $members[] = $create_id;
        foreach ($members as $member) {
            $record = [];
            $record['user_id'] = $member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }
        Chatmanage::insert($manages);
    }

    public static function update($group_id, $members, $create_id){
        Chatmanage::where('group_id', $group_id)->delete();

        $manages = [];
        $members[] = $create_id;
        foreach ($members as $member) {
            $record = [];
            $record['user_id'] = $member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }
        Chatmanage::insert($manages);
    }

}
