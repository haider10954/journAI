<?php

use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\UserController;
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
    Route::get('/login', [AdminAuthController::class, 'index'])->name('admin-login');
    Route::post('/login', [AdminAuthController::class, 'admin_login'])->name('admin_login');
    Route::get('/logout', [AdminAuthController::class, 'admin_logout'])->name('admin_logout');
    Route::get('/mark-as-read', [AdminAuthController::class, 'markAsRead'])->name('markRead');
    Route::get('/mark-all-read', [AdminAuthController::class, 'markAllAsRead'])->name('markAllAsRead');
    Route::middleware('auth:admin')->group(function () {

        //Admin Index
        Route::get('/', [AdminAuthController::class, 'index_page'])->name('admin_index');

        //Admin Profile
        Route::get('/profile', [AdminAuthController::class, 'admin_profile'])->name('admin_profile');
        Route::get('/update-profile', function () {
            return view('admin.update_profile');
        })->name('admin_update_profile_view');
        Route::post('/update_profile', [AdminAuthController::class, 'update_profile'])->name('admin_update_profile');
        Route::post('/update_password', [AdminAuthController::class, 'update_password'])->name('admin_update_password');

        //Admin User Notes
        Route::get('/user-notes/{id?}', [UserNotesController::class, 'index'])->name('admin_user_notes');
        Route::post('/delete-note', [UserNotesController::class, 'delete_notes'])->name('delete_notes');

        //Admin User
        Route::get('/user', [UserController::class, 'user_listing'])->name('admin_user');
        Route::post('/delete-user', [UserController::class, 'delete_user'])->name('delete_user');
        Route::get('/user/edit/{id}', [UserController::class, 'update_user'])->name('update_user');
        Route::post('/edit-user', [UserController::class, 'update_profile'])->name('admin_edit_user');
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
    Route::get('/index', [NoteController::class, 'user_index'])->name('index');

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
