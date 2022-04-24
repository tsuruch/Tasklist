<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MytaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatgroupController;
use App\Http\Controllers\ChatmanageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::get('/login', [LoginController::class, 'loginform'])
    ->name('users.loginform');

Route::post('/users/login', [LoginController::class, 'login'])
    ->name('users.login');

Route::post('/users/logout', [LoginController::class, 'logout'])
    ->name('users.logout');

Route::get('/signup', [LoginController::class, 'signupform'])
    ->name('users.signupform');

Route::post('/user/signup', [LoginController::class, 'signup'])
    ->name('users.signup');

Route::get('/tasks/alltasks/', [TaskController::class, 'alltasks'])
    ->name('tasks.alltasks');

    /*
Route::get('/tasks/alltasks', [TaskController::class, 'alltasks'])
    ->name('tasks.alltasks');
*/
Route::get('/tasks/{task}', [TaskController::class, 'show'])
    ->name('tasks.show')
    ->where('task', '[0-9]+');

Route::post('/tasks/{task}', [TaskController::class, 'notificated'])
    ->name('notificated')
    ->where('task', '[0-9]+');


Route::get('/tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create');

Route::post('/tasks/store', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit')
    ->where('task', '[0-9]+');

Route::patch('/tasks/{task}/update', [TaskController::class, 'update'])
    ->name('tasks.update')
    ->where('task', '[0-9]+');

Route::delete('/tasks/{task}/destroy', [TaskController::class, 'destroy'])
    ->name('tasks.destroy')
    ->where('task', '[0-9]+');

Route::post('/mytasks/{task}/add', [MytaskController::class, 'add'])
    ->name('mytasks.add')
    ->where('task', '[0-9]+');

Route::delete('/mytasks/{task}/destroy', [MytaskController::class, 'destroy'])
    ->name('mytasks.destroy')
    ->where('task', '[0-9]+');

Route::post('/comments/{task}/store', [CommentController::class, 'store'])
    ->name('comments.store')
    ->where('task', '[0-9]+');

Route::get('/tasks/members', [TaskController::class, 'members'])
    ->name('tasks.members');

Route::get('/chatgroups/index', [ChatgroupController::class, 'index'])
    ->name('chatgroups.index');

Route::get('/chatgroups/create', [ChatgroupController::class, 'create'])
    ->name('chatgroups.create');

Route::post('/chatgroups/store', [ChatgroupController::class, 'store'])
    ->name('chatgroups.store');

Route::post('/chatmanages/add', [ChatmanageController::class, 'add'])
    ->name('chatmanages.add');

Route::get('/chatgroups/{group_id}/show', [ChatgroupController::class, 'show'])
    ->name('chatgroups.show')
    ->where('group_id', '[0-9]+');

Route::post('/chats/{group_id}/add', [ChatController::class, 'add'])
    ->name('chats.add')
    ->where('group_id', '[0-9]+');

Route::get('/chatgroups/{group_id}/edit', [ChatgroupController::class, 'edit'])
    ->name('chatgroups.edit')
    ->where('group_id', '[0-9]+');

Route::patch('/chatgroups/{group_id}/update', [ChatgroupController::class, 'update'])
    ->name('chatgroups.update')
    ->where('group_id', '[0-9]+');

Route::delete('/chatgroups/{group_id}/destroy', [ChatgroupController::class, 'destroy'])
    ->name('chatgroups.destroy')
    ->where('group_id', '[0-9]+');

Route::patch('/notification/notificated/{table_name}', [NotificationController::class, 'notificated'])
    ->name('notification.notificated');

Route::get('/setting', [SettingController::class, 'show'])
    ->name('setting');

Route::patch('/setting/usersetting/update', [SettingController::class, 'usersettingupdate'])
    ->name('usersettingupdate');

Route::patch('/setting/user/update', [UserController::class, 'update'])
    ->name('user.update');

Route::get('/admin', [AdminController::class, 'show'])
    ->name('admin');

Route::patch('tasks/processupdate', [TaskController::class, 'processupdate'])
    ->name('tasks.processupdate');
