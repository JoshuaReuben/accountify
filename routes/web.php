<?php


use Livewire\Volt\Volt;
use App\Livewire\Music\MusicEdit;
use App\Livewire\Course\CourseEdit;
use App\Livewire\Course\CourseShow;
use App\Livewire\Lesson\LessonEdit;
use App\Livewire\Lesson\LessonShow;
use App\Livewire\Lesson\LessonCreate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;
use App\Livewire\Question\QuestionCreate;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaypalController;
use App\Livewire\Flashcard\FlashcardCreate;
use App\Livewire\Question\CourseQuestionCreate;
use App\Livewire\Question\ModuleQuestionCreate;
use App\Http\Controllers\Auth\ProviderController;
use App\Livewire\Admin\AdminCreate;

Route::view('/', 'welcome');


// Third Party Logins FB + Google
Route::get('auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('auth/{provider}/callback', [ProviderController::class, 'callback']);


Route::get('/audio/musics/{filename}', [AudioController::class, 'serveAudio']);


Route::view('dashboard', 'dashboard')
    ->middleware(['customauth', 'verified'])
    ->name('dashboard');

// Experiment
Route::view('page1', 'page1')
    ->middleware(['customauth', 'verified'])
    ->name('user.page1');

Route::view('page2', 'page2')
    ->middleware(['customauth', 'verified'])
    ->name('user.page2');

Route::view('profile', 'pages.user.my-profile')
    ->middleware(['customauth'])
    ->name('user.profile');

Route::view('profile/my-account', 'pages.user.my-account')
    ->middleware(['customauth'])
    ->name('user.account');



Route::prefix('admin')->middleware('admin')->group(function () {
    //ADMIN ROUTES (PRE-PENDED WORD ADMIN ON NAMED ROUTES )



    Volt::route('overview', 'pages.admin.overview')->name('admin.overview');

    // TODO: Super Admin middleware
    Route::get('dashboard', AdminCreate::class)->name('admin.dashboard');

    // TO BE DELETED
    Volt::route('create/patient', 'pages.admin.create-patient')->name('admin.create.patient');
    Volt::route('index/patient', 'pages.admin.index-patient')->name('admin.index.patient');


    // PROFILE
    Route::view('profile', 'pages.admin.admin-profile')->name('admin.profile');


    // PAYMENTS - TO BE MOVED TO USERS
    Volt::route('/paypal', 'pages.admin.paypal')->name('admin.paypal');



    // MUSIC
    Route::view('/music/home', 'pages.admin.music')->name('pages.admin.music');
    Route::get('/music/edit/{musicID}', MusicEdit::class)->name('pages.admin.music.edit');



    // COURSES
    Route::view('/courses/home', 'pages.admin.course')->name('pages.admin.course');
    Route::get('/courses/edit/{courseID}', CourseEdit::class)->name('pages.admin.course.edit');
    Route::get('/courses/show/{courseID}', CourseShow::class)->name('pages.admin.course.show');


    // MODULES
    Route::view('/modules/home', 'pages.admin.module')->name('pages.admin.module');

    // RE-ROUTES
    //Re Route to Questions
    // Route::view('/reroute/questions', 'pages.admin.reroute.to-Questions')->name('reroute.admin.question');

    //RE Route to Lessons
    // Route::view('/reroute/lessons', 'pages.admin.reroute.to-Lessons')->name('reroute.admin.lesson');

    // Re Route to Flash Cards
    // Route::view('/reroute/flashcards', 'pages.admin.to-FlashCards')->name('reroute.admin.flashcards');



    // LESSONS
    Route::get('/lessons/create/{courseID}/{moduleID}', LessonCreate::class)->name('pages.admin.lesson');
    Route::get('/lessons/{courseID}/{moduleID}/{lessonID}', LessonShow::class)->name('pages.admin.lesson.show');
    Route::get('/lessons/edit/{courseID}/{moduleID}/{lessonID}', LessonEdit::class)->name('pages.admin.lesson.edit');

    // Lessons thru ajax
    Route::post('/lessons/store', [LessonController::class, 'store'])->name('pages.admin.lesson.store');
    Route::post('/lessons/update', [LessonController::class, 'update'])->name('pages.admin.lesson.update');
    Route::get('/lessons/retrieve', [LessonController::class, 'retrieve'])->name('pages.admin.lesson.retrieve');

    // QUESTIONS - for lessons, modules, courses
    Route::get('/questions/lesson/create/{courseID}/{moduleID}/{lessonID}', QuestionCreate::class)->name('pages.admin.question');
    Route::get('/questions/module/create/{courseID}/{moduleID}', ModuleQuestionCreate::class)->name('pages.admin.question.module');
    Route::get('/questions/course/create/{courseID}', CourseQuestionCreate::class)->name('pages.admin.question.course');

    // FLASH CARDS
    Route::get('/flashcards/{courseID}/{moduleID}/{lessonID}', FlashcardCreate::class)->name('pages.admin.flashcard');

    // RESOURCES TABLE
    Volt::route('/resources/table', 'pages.admin.resources')->name('pages.admin.resources');

    // Experimental Routes
    Volt::route('/scratch', 'pages.admin.scratch')->name('admin.scratch');
}); //End of Admin Routes



//Paypal API Routes
Route::get('paypal/payment/paypal', [PaypalController::class, 'paypal'])->name('paypal.payment.paypal');
Route::get('paypal/payment/success', [PaypalController::class, 'success'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaypalController::class, 'cancel'])->name('paypal.payment.cancel');



require __DIR__ . '/auth.php';
