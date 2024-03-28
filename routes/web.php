<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;

use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\AccessTokenController;



Route::get('/oauth/authorize', [AuthorizationController::class, 'authorize']);
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Register Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/edit', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');

Route::middleware('auth')->group(function () {

    // Route to display tasks
    Route::get('/taskfunc', [TaskController::class, 'index'])->name('taskfunc');

    // Route to store new task
    Route::post('/taskfunc', [TaskController::class, 'store'])->name('store');

    // Route to display specific task
    Route::get('/taskfunc/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

    // Route to update a task
    Route::put('/taskfunc/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    // Route to delete a task
    Route::delete('/taskfunc/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
