<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;

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


    // User Registration Route
    Route::get(Lang::uri('register'), [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    // Login and Logout Route
    Route::get(Lang::uri('login'), [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::post('logout', [LogoutController::class, 'store'])->name('logout');

    Route::get(Lang::uri('posts'), [PostController::class, 'index'])->name('posts.index');
    Route::post(Lang::uri('posts'), [PostController::class, 'create']);
    Route::get(Lang::uri('posts/{id}/show'), [PostController::class, 'show'])->name('posts.show');
    Route::delete(Lang::uri('posts/{post}/delete'), [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post(Lang::uri('posts/{post}/like'), [PostLikeController::class, 'like'])->name('posts.likes');
    Route::delete(Lang::uri('posts/{post}/like'), [PostLikeController::class, 'destroy']);

    // User Posts
    Route::get(Lang::uri('user/{user:username}/posts'), [UserPostController::class, 'index'])->name('user.posts');
});
