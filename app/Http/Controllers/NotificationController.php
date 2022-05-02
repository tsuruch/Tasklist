<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Tasknotification;
use App\Models\Chatnotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('authuser');
    }

    public function notificated (Request $request, $table_name) {
        if ($table_name === 'chats') {

        $notification = Chatnotification::find($request->notification);
        $notification->notificated = true;
        $notification->save();

        return redirect()->route($notification->route, $notification->group_id);

        } else {

        $notification = Tasknotification::find($request->notification);
        $notification->notificated = true;
        $notification->save();

        return redirect()->route($notification->route, $notification->task_id);
        }
    }
}
