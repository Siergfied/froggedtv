<?php

use App\Http\Controllers\LeagueController;
use Illuminate\Support\Facades\Route;

Route::controller(LeagueController::class)->group(function () {
    Route::prefix('league')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('league.index');
        Route::get('create', 'create')->name('league.create');
        Route::post('store', 'store')->name('league.store');
        Route::get('edit', 'edit')->name('league.edit');
        Route::patch('update', 'update')->name('league.update');
        Route::delete('destroy', 'destroy')->name('league.destroy');
    });
});
