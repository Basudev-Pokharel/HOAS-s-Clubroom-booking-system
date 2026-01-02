<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home.page');
Route::get('/login', function () {
    return view('login');
})->name('login.page');
