<?php

use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\UserNotesController;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\NoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admins routes

Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminAuthController::class , 'index'])->name('admin-login');
    Route::post('/login', [AdminAuthController::class , 'admin_login'])->name('admin_login');
    Route::get('/logout', [AdminAuthController::class , 'admin_logout'])->name('admin_logout');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin_index');

        Route::get('/user-notes', [UserNotesController::class, 'index'])->name('admin_user_notes');
        Route::post('/delete-note', [UserNotesController::class, 'delete_notes'])->name('delete_notes');
    });
});




Route::get('/', function () {
    return view('user.login');
})->name('user_login');

Route::post('/user-login', [AuthController::class, 'user_login'])->name('user-login');

Route::get('/logout', [AuthController::class, 'logout'])->name('user_logout');

Route::get('/user/register', function () {
    return view('user.register');
})->name('user_register');

Route::post('/user-signup', [AuthController::class, 'user_signUp'])->name('user_signUp');


Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('user.index');
    })->name('index');

    //Notes
    Route::get('/notes', [NoteController::class, 'notes_listing'])->name('notes');
    Route::post('/add-note', [NoteController::class, 'add_note'])->name('add-note');
    Route::post('/update-post', [NoteController::class, 'edit_note'])->name('edit-note');
    Route::post('/delete-record', [NoteController::class, 'delete_note'])->name('delete-note');

    //Filter Data
    Route::post('/search-data', [NoteController::class, 'filterdata'])->name('filter_data');

    Route::get('/view-notes', function () {
        return view('user.view_note');
    })->name('view_notes');

    Route::get('/user-profile', function () {
        return view('user.user_profile');
    })->name('user_profile');

    Route::get('/user-profile/update', function () {
        return view('user.update_profile');
    })->name('update_profile');
    Route::post('/update_profile', [AuthController::class, 'update_profile'])->name('update-profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
