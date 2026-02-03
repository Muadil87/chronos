<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
// Dashboard Route
Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Task Routes
Route::post('/tasks', [TaskController::class, 'store'])->middleware(['auth', 'verified'])->name('tasks.store');
// Task Routes (Edit, Update, Destroy)
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
// View Single Task Route
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
// Focus Mode Route
Route::get('/tasks/{task}/focus', [TaskController::class, 'focus'])->name('tasks.focus');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
