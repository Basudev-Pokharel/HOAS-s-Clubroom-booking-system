<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::view('/login', 'login')->name('login.page')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::view('/register', 'register')->name('register.page')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
//Login Route for the user
Route::get('/', function () {
    return view('home');
})->name('dashboard')->middleware('auth');
