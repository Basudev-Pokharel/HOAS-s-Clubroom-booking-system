<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAuthenticated;
use App\Http\Middleware\isGuest;

Route::view('/login', 'login')->name('login.page')->middleware(isGuest::class);
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::view('/register', 'register')->name('register.page')->middleware(isGuest::class);
Route::post('/register', [UserController::class, 'register'])->name('user.register');
//Login Route for the user
Route::get('/', function () {
    return view('home');
})->name('dashboard')->middleware(isAuthenticated::class);
Route::patch('/update-password', [UserController::class, 'changePassword'])->name('user.update');
