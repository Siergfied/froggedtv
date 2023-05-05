<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('create', 'create')->name('category.create');
        Route::post('store', 'store')->name('category.store');
    });
});
