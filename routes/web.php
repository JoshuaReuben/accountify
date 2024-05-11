<?php

use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::view('/', 'welcome');


// Third Party Logins FB + Google
Route::get('auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('auth/{provider}/callback', [ProviderController::class, 'callback']);


// Admin Logins




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');




// AFTER AUTHENTICATION
Route::middleware('auth')->group(function () {

    //Volt::route('admin-dashboard', 'admin.dashboard')->name('admin.dashboard');

    //ADMIN ROUTES
    Volt::route('admin/dashboard', 'pages.admin.admin-dashboard')->name('admin.dashboard');
    Volt::route('admin/create/patient', 'pages.admin.create-patient')->name('admin.create.patient');
    Volt::route('admin/index/patient', 'pages.admin.index-patient')->name('admin.index.patient');
});


require __DIR__ . '/auth.php';
