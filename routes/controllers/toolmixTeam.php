<?php

use App\Http\Controllers\ToolmixTeamController;
use Illuminate\Support\Facades\Route;

Route::controller(ToolmixTeamController::class)->group(function () {
    Route::prefix('toolmixTeam')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('toolmixTeam.index');
        Route::get('create', 'create')->name('toolmixTeam.create');
        Route::post('store', 'store')->name('toolmixTeam.store');
        Route::get('edit', 'edit')->name('toolmixTeam.edit');
        Route::patch('update', 'update')->name('toolmixTeam.update');
        Route::delete('destroy', 'destroy')->name('toolmixTeam.destroy');
    });
});
