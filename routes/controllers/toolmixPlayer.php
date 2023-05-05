<?php

use App\Http\Controllers\ToolmixPlayerController;
use Illuminate\Support\Facades\Route;

Route::controller(ToolmixPlayerController::class)->group(function () {
    Route::prefix('toolmixPlayer')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('toolmixPlayer.index');
        Route::get('create', 'create')->name('toolmixPlayer.create');
        Route::post('store', 'store')->name('toolmixPlayer.store');
        Route::get('edit', 'edit')->name('toolmixPlayer.edit');
        Route::patch('update', 'update')->name('toolmixPlayer.update');
        Route::delete('destroy', 'destroy')->name('toolmixPlayer.destroy');
    });
});
