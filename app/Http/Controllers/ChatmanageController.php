<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatmanage;

class ChatmanageController extends Controller
{
    public function add($group_id, $members){
        $manages = [];
        foreach ($members as $member) {
            $record = [];
            $record['user_id'] = $member;
            $record['group_id'] = $group_id;
            $manages[] = $record;
        }
        Chatmanage::insert($manages);

        return redirect()->route('chatgroups.show');
    }
}
