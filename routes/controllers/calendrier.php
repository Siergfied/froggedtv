<?php

use App\Http\Controllers\CalendrierController;
use Illuminate\Support\Facades\Route;

Route::controller(CalendrierController::class)->group(function () {
    Route::prefix('calendrier')->group(function () {
        Route::get('/', 'index')->name('calendrier.index');
    });
});
