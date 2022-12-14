<?php

use App\Http\Controllers\user\AuthController;
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

Route::get('/', function () {
    return view('user.login');
})->name('user_login');

Route::post('/user-login', [AuthController::class, 'user_login'])->name('user-login');
Route::get('/logout',[AuthController::class , 'logout'])->name('user_logout');
Route::get('/user/register', function () {
    return view('user.register');
})->name('user_register');
Route::post('/user-signup', [AuthController::class, 'user_signUp'])->name('user_signUp');


Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('user.index');
    })->name('index');

    Route::get('/notes', function () {
        return view('user.notes');
    })->name('notes');

    Route::get('/view-notes', function () {
        return view('user.view_note');
    })->name('view_notes');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
