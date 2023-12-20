<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect("/login");
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'registerStore'])->name('login.register');

// Route::get('/', 'App\Http\Controllers\PusherController@index')->name('pusher');
// Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast')->name('broadcast');
// Route::post('/receive', 'App\Http\Controllers\PusherController@receive')->name('receive');



Route::prefix("/admin")->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('school-years', SchoolYearController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('events', EventController::class);

    Route::post('/subjects/{subject}/add-student', [SubjectController::class, 'addStudent'])->name('subjects.add-student');
    Route::post('/subjects/{subject}/add-topic', [SubjectController::class, 'addSubjectTopic'])->name('subjects.add-topic');
    Route::post('/subjects/{subject}/add-exam', [SubjectController::class, 'addExam'])->name('subjects.add-exam');
    Route::post('/subjects/{subject}/{exam}/{question}/save-question', [SubjectController::class, 'saveQuestion'])->name('subjects.save-question');
    Route::get('subjects/{subject}/{exam}/{question}/edit-question', [SubjectController::class, 'viewEditQuestion'])->name('subjects.edit-question');
    Route::get('subjects/{subject}/create-exam', [SubjectController::class, 'createExam'])->name('subjects.create-exam');
    Route::get('subjects/{subject}/show-all', [SubjectController::class, 'showAllTopics'])->name('subjects.show-all-topics');
    Route::get('subjects/{subject}/{exam}/show-exam', [SubjectController::class, 'showExam'])->name('subjects.show-exam');
    Route::get('/contacts/{contact}/activate', [ContactController::class, 'activate'])->name('contacts.activate');
    Route::get('/contacts/{contact}/deactivate', [ContactController::class, 'deactivate'])->name('contacts.deactivate');

    Route::get('/messages' , [MessageController::class, 'index'])->name('messages.index');

    Route::get('/logs/admin', [LogController::class, 'adminLogs'])->name('logs.admin');
    Route::get('/logs/user', [LogController::class, 'userLogs'])->name('logs.user');
});
