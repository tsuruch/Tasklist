<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    //

    public function store(CommentRequest $request, Task $task) {
        $comment = new Comment;

        $comment->user_id = session('user_id');
        $comment->task_id = $task->id;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }
}
