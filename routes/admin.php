<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminauthsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;




Route::prefix('admin')->group(function () {

    //AUTH
    Route::get('/login', [AdminauthsController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminauthsController::class, 'login'])->name('admin.login.submit');

});


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    //WEB CONFIF
    Route::prefix('web-config')->controller(WebConfigController::class)->group(function () {
        Route::get('/edit-web', 'edit')->name('webconfig.edit');
        Route::post('/web-update', 'update')->name('web_config.update');
        Route::post('/banner-section', 'bannerSection')->name('web_config.banner_section');
       Route::match(['get', 'post'], '/about-section', 'aboutSection')->name('web_config.about_section');
    });
    //AUTH
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [AdminauthsController::class, 'logout'])->name('logout');
        Route::get('/edit-profile-admin', [AdminauthsController::class, 'profile_edit'])->name('profile');
        Route::put('/profile/{id}', [AdminauthsController::class, 'update'])->name('profile.update');
    });
    //
    // Services
    Route::get('/service-list', [ServiceController::class, 'list'])->name('service.list');
    Route::post('/store-service', [ServiceController::class, 'store'])->name('storeService');
    Route::get('/edit-service/{id}', [ServiceController::class, 'service_edit'])->name('editService');
    Route::post('/update-service/{id}', [ServiceController::class, 'update'])->name('updateService');
    Route::delete('/deleteService', [ServiceController::class, 'destroy'])->name('service_delete');

    // Blogs
    Route::get('/blog-list', [BlogController::class, 'list'])->name('blog.list');
    Route::post('/store-blog', [BlogController::class, 'store'])->name('storeBlog');
    Route::get('/edit-blog/{id}', [BlogController::class, 'blog_edit'])->name('editBlog');
    Route::post('/update-blog/{id}', [BlogController::class, 'update'])->name('updateBlog');
    Route::delete('/deleteBlog', [BlogController::class, 'destroy'])->name('blog_delete');
    //User
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/users', [ManageUserController::class, 'list'])->name('user.list');
    Route::get('/edit-user/{id}', [ManageUserController::class, 'editUser'])->name('editUser');
    Route::post('/update-user/{id}', [ManageUserController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser', [ManageUserController::class, 'destroy'])->name('deleteUser');

    //Banner
    Route::get('/banner-list', [BannerController::class, 'list'])->name('banner.list');
    Route::post('/store-Banner', [BannerController::class, 'store'])->name('storeBanner');
    Route::get('/edit-banner/{id}', [BannerController::class, 'banner_edit'])->name('editBanner');
    Route::post('/update-Banner/{id}', [BannerController::class, 'update'])->name('updatbanner');
    Route::delete('/deleteBanner', [BannerController::class, 'destroy'])->name('banner_delete');
    //Transactions
    Route::get('/transactions', [TransactionController::class, 'list'])->name('transaction.list');

});







