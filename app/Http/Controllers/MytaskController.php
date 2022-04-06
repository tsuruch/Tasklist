<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Mytask;

class MytaskController extends Controller
{
    //
    public function add(Request $request, Task $task) {
        $mytask = new Mytask();
        $mytask->task_id = $task->id;
        $mytask->user_id = $request->user_id;
        $mytask->save();

        return back();
    }


    public function destroy(Request $request, Task $task) {
        $findtask = Mytask::where('task_id', '=', $task->id)
                        ->where('user_id', '=', $request->user_id)
                        ->value('id');

        $mytask = Mytask::find($findtask);
        $mytask->delete();

        return back();
    }
}
