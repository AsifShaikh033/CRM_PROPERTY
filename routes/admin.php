<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminauthsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\RoleController;

// ----------------------------- //
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\BookingController;
Route::prefix('admin')->group(function () {

    //AUTH
    Route::get('/login', [AdminauthsController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminauthsController::class, 'login'])->name('admin.login.submit');

});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

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

    //User
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/users', [ManageUserController::class, 'list'])->name('user.list')->middleware('permission:users.view');
    Route::get('/users/create', [ManageUserController::class, 'create'])->name('user.create')->middleware('permission:users.create');
    Route::post('/users/store', [ManageUserController::class, 'store'])->name('user.store')->middleware('permission:users.create');
    Route::get('/edit-user/{id}', [ManageUserController::class, 'editUser'])->name('editUser')->middleware('permission:users.edit');
    Route::post('/update-user/{id}', [ManageUserController::class, 'updateUser'])->name('updateUser')->middleware('permission:users.edit');
    Route::post('/deleteUser', [ManageUserController::class, 'destroy'])->name('deleteUser')->middleware('permission:users.delete');
    //Agents
    Route::get('/users/type/agents', [ManageUserController::class, 'agentList'])->name('agent.list')->middleware('permission:agents.view');
    //Owners
    Route::get('/users/type/owners', [ManageUserController::class, 'ownerList'])->name('owner.list')->middleware('permission:owners.view');
    //Tenants
    Route::get('/users/type/tenants', [ManageUserController::class, 'tenantList'])->name('tenant.list')->middleware('permission:tenants.view');
    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    Route::get('/roles', [RoleController::class, 'index']) ->middleware('permission:roles.view')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create']) ->middleware('permission:roles.create')->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store']) ->middleware('permission:roles.create')->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit']) ->middleware('permission:roles.edit')->name('roles.edit');
    Route::post('/roles/{id}/update', [RoleController::class, 'update']) ->middleware('permission:roles.edit')->name('roles.update');
    Route::post('/roles/{id}/delete', [RoleController::class, 'destroy']) ->middleware('permission:roles.delete')->name('roles.delete');


    //Transactions
    Route::get('/transactions', [TransactionController::class, 'list'])->name('transaction.list');

    // --------------------------- //
    Route::resource('properties', PropertyController::class);
    Route::resource('property-types', PropertyTypeController::class)->except(['show']);
    Route::resource('bookings', BookingController::class);
});







