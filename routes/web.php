<?php


use Livewire\Volt\Volt;
use App\Livewire\Music\MusicEdit;
use App\Livewire\Course\CourseEdit;
use App\Livewire\Course\CourseShow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\AdminEmailVerifyController;

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
    Route::get('/music/edit/{musicID}', MusicEdit::class)->name('pages.admin.music.edit');



    // COURSES
    Route::view('/courses/home', 'pages.admin.course')->name('pages.admin.course');
    Route::get('/courses/edit/{courseID}', CourseEdit::class)->name('pages.admin.course.edit');
    Route::get('/courses/show/{courseID}', CourseShow::class)->name('pages.admin.course.show');

    //- show ++ module create
    // Route::get('/courses/show/{courseID}', function ($courseID) {
    //     return view('pages.admin.course-show')->with('course', Course::find($courseID));
    // })->name('pages.admin.course.show');




    // MODULES
    Route::get('/modules/home', function () {
        return view('pages.admin.module');
    })->name('pages.admin.module');





    // Experimental Routes
    Volt::route('/scratch', 'pages.admin.scratch')->name('admin.scratch');

    Route::get('verify-email/{id}/{token}', [AdminEmailVerifyController::class, 'verifyEmail'])->name('admin.verify.email');
}); //End of Admin Routes



//Paypal API Routes
Route::get('paypal/payment/paypal', [PaypalController::class, 'paypal'])->name('paypal.payment.paypal');
Route::get('paypal/payment/success', [PaypalController::class, 'success'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaypalController::class, 'cancel'])->name('paypal.payment.cancel');



require __DIR__ . '/auth.php';
