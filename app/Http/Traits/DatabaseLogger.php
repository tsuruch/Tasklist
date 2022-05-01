<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Tasknotification;
use App\Models\Chatnotification;
use App\Models\Mytask;
use App\Models\Chatmanage;
use App\Models\User;

trait DatabaseLogger
{
  protected static function bootDatabaseLogger()
  {


    self::created(function ($model) {

        $table_name = $model->getTable();
        $user_id = session('user_id');
        if ($table_name !== 'chatgroups' && $table_name !== 'tasks') {
            switch ($table_name) {
                /* Tasknotificationに外部キー制約を持たせているので、そこにいれられない*/

                /*
                case 'tasks':
                    $message = 'タスク:'.$model->name.'が追加されました';
                    $route = 'tasks.show';
                    $task_id = $model->id;
                    $user_ids = User::pluck('id')->toArray();
                    break;
                case 'chatgroups':
                    $message = 'チャットグループ:'.$model->name.'に追加されました';
                    $route = 'chatgroups.show';
                    $model_id = $model->id;
                    break;*/
                case 'comments':
                    $message = 'タスク:'.$model->task->name.'に新しいコメントがあります!';
                    $route = 'tasks.show';
                    $task_id = $model->task->id;
                    /*コメントからタスクをリレーションでつかみ、そこからマイタスクをとってきてそのuser_id列を取得*/
                    $user_ids = $model->task->mytasks->pluck('user_id')->toArray();
                    break;
                case 'chats':
                    $message = 'チャットグループ:'.$model->chatgroup->name.'に新しいコメントがあります!';
                    $route = 'chatgroups.show';
                    $group_id = $model->chatgroup->id;
                    /*チャットからグループをつかみ、チャットマネージからuser_idを取得*/
                    $user_ids = $model->chatgroup->chatmanages->pluck('user_id')->toArray();
                    break;
            }

            if ($table_name === 'tasks' || $table_name === 'comments') {
                foreach ($user_ids as $user_id) {
                    $notification = new Tasknotification();
                    $notification->table_name = $table_name;
                    $notification->message = $message;
                    $notification->route = $route;
                    $notification->task_id = $task_id;
                    $notification->user_id = $user_id;
                    $notification->save();

                }
            } else {
                foreach ($user_ids as $user_id) {
                    $notification = new Chatnotification();
                    $notification->table_name = $table_name;
                    $notification->message = $message;
                    $notification->route = $route;
                    $notification->group_id = $group_id;
                    $notification->user_id = $user_id;
                    $notification->save();

                }


            }


        }
    });
    self::updated(function ($model) {

        $table_name = $model->getTable();
        if ($table_name === 'tasks') {
                $message = 'タスク:'.$model->name.'が更新されました';
                $route = 'tasks.show';
                $notification = new Tasknotification();
                $notification->table_name = $table_name;
                $notification->task_id = $model->id;
                $notification->user_id = session('user_id');
                $notification->message = $message;
                $notification->route = $route;
                $notification->save();
        }
    });
    /*
    self::deleted(function ($model) {
        $class = get_class($model);
        Log::info("Created '{$class}': {$model}");
    });*/
  }
}
