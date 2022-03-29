<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TaskController extends Controller

{
    //
    public function index() {
        $tasks = Task::latest()->get();


        return view('index')
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
        $task->save();

        return redirect()->route('tasks.show', $task);
    }

    public function destroy(Task $task) {
        $task->delete();

        return redirect()->route('tasks.index');
    }



}
