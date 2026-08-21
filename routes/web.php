<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;


    
    // Dashboard
    Route::prefix('')->name('admin.')->middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-user', [AuthController::class, 'loginuser_auth'])->name('loginuser');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');
   
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        // Logout route
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        //user routes
        Route::get('/profile', [UserController::class, 'profiles'])->name('profile');
        Route::post('/update-profile-user', [UserController::class, 'updateprofile'])->name('updateprofile');
    });
    




