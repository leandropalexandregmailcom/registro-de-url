<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    UserController,
    UrlController,
    LoginController,
    LogUrlController
};

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('logar', [LoginController::class, 'logar'])->name('logar');
Route::get('show', [UserController::class, 'show'])->name('show.user');
Route::post('create', [UserController::class, 'create'])->name('create.user');

Route::middleware('auth')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('home.user');
});

Route::prefix('user/')->middleware('auth')->group(function() {

    //Usuário
    Route::get('index', [UserController::class, 'index'])->name('home.user');
    Route::get('edit', [UserController::class, 'edit'])->name('edit.user');
    Route::post('update', [UserController::class, 'update'])->name('update.user');
    Route::post('delete', [UserController::class, 'delete'])->name('delete.user');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('url/')->group(function() {

        //Url
        Route::get('index', [UrlController::class, 'index'])->name('index.url');
        Route::get('show', [UrlController::class, 'show'])->name('show.url');
        Route::get('status/{id}', [UrlController::class, 'status'])->name('status.url');
        Route::post('create', [UrlController::class, 'create'])->name('create.url');
        Route::post('delete', [UrlController::class, 'delete'])->name('delete.url');

        //LogUrl
        Route::prefix('log/')->group(function() {

            Route::get('index/{id}', [LogUrlController::class, 'index'])->name('index.log_url');
        });

    });

});
