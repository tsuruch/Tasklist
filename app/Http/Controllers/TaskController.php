<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Mytask;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Pagination\Paginator;
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
        $params = ['filter' => $filter, 'columns' => $columns];
        $filtermsg = "";
        $mytasks = Mytask::where('user_id', session('user_id'))->pluck('task_id')->toArray();
        if (!isset($filter) || empty($columns)) {
            $tasks = Task::orderBy('deadline', 'asc')->paginate(10);
        }else{
            $tasks = Task::where(function($query) use($columns, $filter){
                $i = 0;
                foreach ($columns as $column) {
                    $where = (!$i) ? 'where': 'orWhere';
                    $i++;
                    $query->$where($column, 'LIKE', '%'.$filter.'%');
                }

            })->paginate(10);
            $filtermsg = 'キーワード['.$filter.']を含むタスクを表示中';
        }

        return view('tasks.alltasks')
        ->with(['tasks' => $tasks, 'filtermsg' => $filtermsg, 'mytasks' => $mytasks, 'params' => $params]);
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
        $selfnotification = 'タスク：'.$task->name.'を作成しました';
        session(['selfnotification'=>$selfnotification]);

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
        $task->detail = $request->detail;
        $task->save();
        $selfnotification = $task->name.'の内容を更新しました';
        session(['selfnotification'=>$selfnotification]);
        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task) {
        $task_name = $task->name;
        $task->delete();
        $selfnotification = 'タスク：'.$task_name.'を削除しました';
        session(['selfnotification'=>$selfnotification]);
        return redirect()->route('tasks.index');
    }


    public function members() {

        $users = User::oldest()->paginate(10);
        return view('tasks.members')
                ->with(['users'=>$users]);
    }


    public function processupdate(Request $request) {
        $taskid_processname = explode("_", $request->taskid_processname);
        $task_id = $taskid_processname[0];
        $processname = $taskid_processname[1];
        $input_value = $request->input_value;
        $task = Task::find($task_id);
        $task->$processname = $input_value;
        $task->save();
        $selfnotification = $task->name.'の進捗を更新しました';
        session(['selfnotification'=>$selfnotification]);
        return back();
    }

}
