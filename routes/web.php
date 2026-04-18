<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tasks.index');
    }
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Tasks
    Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('calendar.index');
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
    Route::resource('tasks', TaskController::class);

    // Sub-tasks
    Route::post('/tasks/{task}/sub-tasks', [SubTaskController::class, 'store'])->name('sub_tasks.store');
    Route::post('/sub-tasks/{subTask}/toggle', [SubTaskController::class, 'toggleComplete'])->name('sub_tasks.toggle');
    Route::delete('/sub-tasks/{subTask}', [SubTaskController::class, 'destroy'])->name('sub_tasks.destroy');

    // Categories
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

    // Profile (Placeholder route for now)
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile.index');
});
