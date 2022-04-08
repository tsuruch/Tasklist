<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Mytask;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Exists;
use PhpParser\Node\Stmt\Foreach_;

class TaskController extends Controller

{
    //
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public function index() {
        $mytasks = Mytask::where('user_id', session('user_id'))->get();
        return view('index')
        ->with(['mytasks' => $mytasks]);
    }

    public function alltasks(Request $request) {
        $filter = $request->filter;
        $columns = $request->columns;
        $filtermsg = "";
        if (!isset($filter)) {
            $tasks = Task::latest()->get();
        }else{
            $tasks = Task::where(function($query) use($columns, $filter){
                $i = 0;
                foreach ($columns as $column) {
                    $where = (!$i) ? 'where': 'orWhere';
                    $i++;
                    $query->$where($column, 'LIKE', '%'.$filter.'%');
                }

            })->get();
            $filtermsg = 'キーワード['.$filter.']を含むタスクを表示中';
        }

        return view('tasks.alltasks')
        ->with(['tasks' => $tasks, 'filtermsg' => $filtermsg]);
    }

    public function filter($filter) {
        $tasks = Task::where('name', 'LIKE', '%'.$filter.'%')->get();
    return view('tasks.alltasks')
    ->with(['tasks' => $tasks]);
}



    public function show(Task $task) {
        $mytask_judge = Mytask::where('user_id', session('user_id'))
                        ->where('task_id', $task->id)->exists();
        $comments = Comment::where('task_id', $task->id)->get();
        return view('tasks.show')
        ->with(['task'=>$task, 'mytask_judge'=>$mytask_judge, 'comments'=>$comments]);
    }


    public function create() {
        return view('tasks.create');
    }


    public function store(TaskRequest $request) {
        $task = new Task();
        $task->name = $request->name;
        $task->deadline = $request->deadline;
        $task->detail = $request->detail;
        $task->save();


        return redirect()->route('tasks.index');
    }


    public function edit(Task $task) {
        return view('tasks.edit')
        ->with(['task'=>$task]);
    }

    public function update(TaskRequest $request, Task $task) {
        $task->name = $request->name;
        $task->deadline = $request->deadline;
        $task->process1 = $request->process1;
        $task->process2 = $request->process2;
        $task->process3 = $request->process3;
        $task->process4 = $request->process4;
        $task->save();

        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task) {
        $task->delete();

        return redirect()->route('tasks.index');
    }



}
