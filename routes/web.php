<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PropertyVisitController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\RentalAgreementController;
use App\Http\Controllers\Admin\RentPaymentController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\VendorController;

Route::get('/', fn () => redirect()->route('admin.dashboard'));

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('properties', PropertyController::class);
    Route::get('properties/{property}/units', [PropertyController::class, 'units'])->name('properties.units');

   Route::resource('property-types', PropertyTypeController::class)
    ->except(['show'])
    ->parameters([
        'property-types' => 'propertyType'
    ]);
    Route::resource('owners', OwnerController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('visits', PropertyVisitController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('agreements', RentalAgreementController::class);
    Route::resource('rent-payments', RentPaymentController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('maintenance', MaintenanceController::class);
    Route::resource('vendors', VendorController::class);
});