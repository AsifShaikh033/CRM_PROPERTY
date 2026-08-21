<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;


    

Route::get('/link-storage', function () {
    try {
       $target = storage_path('app/public');
        $link = public_path('storage');
        if (!file_exists($link)) {
            \File::copyDirectory($target, $link);
        }
        return response()->json([
            'success' => true,
            'message' => 'Storage link created successfully!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage(),
        ], 500);
    }
});
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
    




