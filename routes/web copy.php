<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;



   
    //Website 
    Route::get('/', [WebController::class, 'index'])->name('website.index');
    Route::get('/about-us', [WebController::class, 'about'])->name('website.about');
    Route::get('/services', [WebController::class, 'services'])->name('website.services');
    Route::get('/services/{slug}', [WebController::class, 'serviceDetails'])->name('website.service.details');
    Route::get('/blog', [WebController::class, 'blog'])->name('website.blog');
    Route::get('/blog/{slug}', [WebController::class, 'blogDetails'])->name('website.blog.details');
    Route::get('/contact-us', [WebController::class, 'contact'])->name('website.contact');
    //USER START

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
    




