<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Mytask;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

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

    public function alltasks() {
        $tasks = Task::latest()->get();

        return view('tasks.alltasks')
        ->with(['tasks' => $tasks]);
    }


    public function show(Task $task) {
        return view('tasks.show')
        ->with(['task'=>$task]);
    }


    public function create() {
        return view('tasks.create');
    }


    public function store(TaskRequest $request) {
        $task = new Task();
        $task->name = $request->name;
        $task->deadline = $request->deadline;
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
