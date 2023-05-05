<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::controller(TeamController::class)->group(function () {
    Route::prefix('team')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('team.index');
        Route::get('create', 'create')->name('team.create');
        Route::post('store', 'store')->name('team.store');
        Route::get('{team_id}', 'show')->name('team.show');
        Route::get('{team_id}/edit', 'edit')->name('team.edit');
        Route::patch('{team_id}/update', 'update')->name('team.update');
        Route::post('{team_id}/join', 'join')->name('team.join');
        Route::post('{team_id}/leave', 'leave')->name('team.leave');
        Route::post('{user_id}/kick', 'kick')->name('team.kick');
        Route::patch('{user_id}/updateCaptain', 'updateCaptain')->name('team.updateCaptain');
        Route::get('{user_id}/updateViceCaptain', 'updateViceCaptain')->name('team.updateViceCaptain');
        Route::get('{user_id}/removeViceCaptain', 'removeViceCaptain')->name('team.removeViceCaptain');
        Route::get('{user_id}/updateCoach', 'updateCoach')->name('team.updateCoach');
        Route::get('{user_id}/removeCoach', 'removeCoach')->name('team.removeCoach');
    });
});
