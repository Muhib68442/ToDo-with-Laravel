<?php

use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('task', TaskController::class)->names('web.task')->middleware(isLogin::class);
Route::get('/task/toggle/{id}', [TaskController::class, 'toggle'])->name('web.task.toggle')->middleware(isLogin::class);

Route::get('/signup', [AuthController::class, 'signupShow'])->name('web.user.signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('web.user.signup.post');

Route::get('/login', [AuthController::class, 'loginShow'])->name('web.user.login');
Route::post('/login', [AuthController::class, 'login'])->name('web.user.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('web.user.logout')->middleware(isLogin::class);

Route::resource('/user', UserController::class)->names('web.user')->middleware(isLogin::class);