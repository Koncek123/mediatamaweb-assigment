<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])
        ->middleware('guest')
        ->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [adminController::class, 'index']);
        Route::resource('author',AuthorController::class)->except(['show']);
        Route::resource('category',CategoryController::class)->except(['show']);
        Route::resource('tag',TagController::class)->except(['show']);
        Route::resource('article',ArticleController::class);
    });
});