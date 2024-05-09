<?php

use App\Http\Controllers\Auth\ProviderController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('/scratch', 'scratch')->name('scratch');

// Route::get('/auth/google/redirect', [ProviderController::class, 'redirectGoogle']);
// Route::get('/auth/facebook/redirect', [ProviderController::class, 'redirectFacebook']);


// Route::get('/auth/google/callback', [ProviderController::class, 'callbackGoogle']);
// Route::get('/auth/facebook/callback', [ProviderController::class, 'callbackFacebook']);

Route::get('auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('auth/{provider}/callback', [ProviderController::class, 'callback']);







Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
