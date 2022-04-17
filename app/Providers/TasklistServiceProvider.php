<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Mytask;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Chatmanage;
use App\Models\Tasknotification;

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
            $tasknotifications = Tasknotification::where('user_id', session('user_id'))->latest()->get();
            $view->with('tasknotifications', $tasknotifications);
        });
    }
}
