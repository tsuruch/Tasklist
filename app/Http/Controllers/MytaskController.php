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

        return redirect()->route('tasks.index');
    }
}
