<?php

use App\Http\Controllers\ToolmixTeamController;
use Illuminate\Support\Facades\Route;

Route::controller(LeagueDivisionController::class)->group(function () {
    Route::prefix('division')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('division.index');
        Route::get('create', 'create')->name('division.create');
        Route::post('store', 'store')->name('division.store');
        Route::get('edit', 'edit')->name('division.edit');
        Route::patch('update', 'update')->name('division.update');
        Route::delete('destroy', 'destroy')->name('division.destroy');
    });
});
