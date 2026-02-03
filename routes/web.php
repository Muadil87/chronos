<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimerController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Task Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/focus', [TaskController::class, 'focus'])->name('tasks.focus');
    Route::post('/tasks/{task}/record', [TaskController::class, 'recordSession'])->name('tasks.record');
});

// Timer Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/timer', [TimerController::class, 'index'])->name('timer.index');
    Route::get('/timer/start', [TimerController::class, 'show'])->name('timer.show');
});

// Stats Route
Route::get('/stats', [TaskController::class, 'stats'])->middleware(['auth', 'verified'])->name('stats');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

require __DIR__.'/auth.php';
