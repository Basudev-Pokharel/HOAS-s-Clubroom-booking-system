<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\UserAddressIdController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAddressed;
use App\Http\Middleware\isAuthenticated;
use App\Http\Middleware\isGuest;
use App\Http\Middleware\UserAddressMiddleware;

Route::view('/login', 'login')->name('login.page')->middleware(isGuest::class);
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::view('/register', 'register')->name('register.page')->middleware(isGuest::class);
Route::post('/register', [UserController::class, 'register'])->name('user.register');
//Login Route for the user
Route::get('/', [HomeController::class, 'getHome'])->name('dashboard')->middleware(UserAddressMiddleware::class);

//Validate with the user address then
Route::view('/validate', 'guest.login')->name('validate.page');
Route::post('/validate_register', [UserAddressIdController::class, 'registerOrLogin'])->name('guest.address.register');

Route::patch('/update-password', [UserController::class, 'changePassword'])->name('user.update');
Route::post('/book/{id}', [BookingController::class, 'book'])->name('slot.book');
Route::post('/bookings/full-day', [BookingController::class, 'bookFullDay'])
    ->name('booking.full-day');
Route::post('/cancel/{id}', [BookingController::class, 'cancel'])->name('slot.cancel');

// Routes for admins
Route::view('/login_admin', 'admin.login')->name('admin.login.page')->middleware(isGuest::class);
Route::post('/admin-login', [UserController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin', [BookingController::class, 'viewBookingsAdmin'])->name('admin.user.dashboard')->middleware(isAuthenticated::class);
Route::post('/cancel-admin', [BookingController::class, 'cancelByAdmin'])->name('admin.slot.cancel');
Route::post('/make-admin', [UserController::class, 'promoteToAdmin'])->name('admin.promote.member');
Route::post('/remove-admin', [UserController::class, 'removeToNonAdmin'])->name('admin.remove.member');
Route::post('/delete-people-admin', [UserController::class, 'deleteUser'])->name('admin.delete.member');
