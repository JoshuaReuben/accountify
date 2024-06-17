<?php


use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\AdminEmailVerifyController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PaypalController;

Route::view('/', 'welcome');


// Third Party Logins FB + Google
Route::get('auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('auth/{provider}/callback', [ProviderController::class, 'callback']);


Route::get('/audio/musics/{filename}', [AudioController::class, 'serveAudio']);


Route::view('dashboard', 'dashboard')
    ->middleware(['customauth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['customauth'])
    ->name('profile');



Route::prefix('admin')->middleware('admin')->group(function () {
    //ADMIN ROUTES (PRE-PENDED WORD ADMIN ON NAMED ROUTES )
    Volt::route('dashboard', 'pages.admin.admin-dashboard')->name('admin.dashboard');
    Volt::route('create/patient', 'pages.admin.create-patient')->name('admin.create.patient');
    Volt::route('index/patient', 'pages.admin.index-patient')->name('admin.index.patient');

    Volt::route('/paypal', 'pages.admin.paypal')->name('admin.paypal');

    // MUSIC
    Route::view('/music/home', 'pages.admin.music')->name('pages.admin.music');
    Route::get('/music/delete/{musicID}', [MusicController::class, 'destroy']);
    Route::get('/music/edit/{musicID}', [MusicController::class, 'edit']);
    Route::view('/music/edit/page', 'pages.admin.music-edit')->name('pages.admin.music.edit');

    // Experimental Routes

    Volt::route('/scratch', 'pages.admin.scratch')->name('admin.scratch');



    Route::get('verify-email/{id}/{token}', [AdminEmailVerifyController::class, 'verifyEmail'])->name('admin.verify.email');
});



//Paypal API Routes
Route::get('paypal/payment/paypal', [PaypalController::class, 'paypal'])->name('paypal.payment.paypal');
Route::get('paypal/payment/success', [PaypalController::class, 'success'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaypalController::class, 'cancel'])->name('paypal.payment.cancel');



require __DIR__ . '/auth.php';
