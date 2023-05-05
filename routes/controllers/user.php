<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('{id}', 'show')->name('user.show');
        Route::get('{id}/edit', 'edit')->name('user.edit');
        Route::patch('{id}/update', 'update')->name('user.update');
    });
});
