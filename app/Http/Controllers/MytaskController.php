<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Mytask;

class MytaskController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public function add(Request $request, Task $task) {
        $mytask = new Mytask();
        $mytask->task_id = $task->id;
        $mytask->user_id = $request->user_id;
        $mytask->save();
        $selfnotification = $task->name.'をマイタスクに追加しました';
        session(['selfnotification'=>$selfnotification]);
        return back();
    }


    public function destroy(Request $request, Task $task) {
        $findtask = Mytask::where('task_id', '=', $task->id)
                        ->where('user_id', '=', $request->user_id)
                        ->value('id');

        $mytask = Mytask::find($findtask);
        $mytask->delete();
        $selfnotification = $task->name.'をマイタスクから削除しました';
        session(['selfnotification'=>$selfnotification]);
        return back();
    }
}
