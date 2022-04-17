<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Tasknotification;

class NotificationController extends Controller
{
    public function notificated (Request $request) {
        $notification = Tasknotification::find($request->notification);
        $notification->notificated = true;
        $notification->save();

        return redirect()->route($notification->route, $notification->task_id);
    }
}
