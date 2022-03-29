<?php

use App\Http\Controllers\TaskController;
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

Route::get('/tasks/{task}', [TaskController::class, 'show'])
    ->name('tasks.show')
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

