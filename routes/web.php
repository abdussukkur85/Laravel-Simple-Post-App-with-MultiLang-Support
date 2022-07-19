<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::localized(function () {
    Route::get(Lang::uri('/'), function () {
        return view('home');
    })->name('home');

    Route::get(Lang::uri('dashboard'), [DashboardController::class, 'index'])->name('dashboard');
    // User Registration Route
    Route::get(Lang::uri('register'), [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    // Login and Logout Route
    Route::get(Lang::uri('login'), [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::post('logout', [LogoutController::class, 'store'])->name('logout');

    Route::get('/posts', function () {
        return view('posts.index');
    });
});
