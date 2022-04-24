<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Mytask;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Chatmanage;
use App\Models\Tasknotification;
use App\Models\Chatnotification;
use App\Models\User;

class TasklistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function($view) {
            if (strpos(url()->current(), 'log')==false && strpos(url()->current(), 'signup')==false) {
                $user = User::find(session('user_id'));
                $usersetting = $user->usersetting;
                $is_admin = $user->is_admin;
                $tasknotify = [];
                $chatnotify = [];
                if ($usersetting->commentnotify) {
                    $tasknotify[] = 'comments';
                }

                if ($usersetting->chatnotify) {
                    $chatnotify[] = 'chats';
                }

                if ($usersetting->tasknotify) {
                    $tasknotify[] = 'tasks';
                }

                if ($usersetting->chatgroupnotify) {
                    $chatnotify[] = 'chatgroups';
                }

                $tasknotifications = Tasknotification::where('user_id', session('user_id'))
                                                        ->whereIn('table_name', $tasknotify)->latest()->limit(5)->get();
                $chatnotifications = Chatnotification::where('user_id', session('user_id'))
                                                        ->whereIn('table_name', $chatnotify)->latest()->limit(5)->get();

                $view->with(['tasknotifications'=>$tasknotifications, 'chatnotifications'=>$chatnotifications, 'is_admin'=>$is_admin]);
       # code...
            }
        });
    }
}
