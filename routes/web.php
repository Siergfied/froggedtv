<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::controller(ArticleController::class)->group(function () {
    Route::prefix('article')->group(function () {
        Route::get('all', 'index')->name('article.index');
        Route::get('create', 'create')
            ->name('article.create')
            ->middleware('auth');
        Route::post('store', 'store')
            ->name('article.store')
            ->middleware('auth');
        Route::get('user', 'user')
            ->name('article.user')
            ->middleware('auth');
        Route::get('{slug}', 'show')->name('article.show');
        Route::get('edit/{id}', 'edit')
            ->name('article.edit')
            ->middleware('auth');
        Route::patch('update/{id}', 'update')
            ->name('article.update')
            ->middleware('auth');
        Route::get('category/{slug}', 'category')->name('article.category');
    });
});

Route::controller(CalendrierController::class)->group(function () {
    Route::prefix('calendrier')->group(function () {
        Route::get('/', 'index')->name('calendrier.index');
    });
});

Route::controller(CategoryController::class)->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('create', 'create')->name('category.create');
        Route::post('store', 'store')->name('category.store');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('{id}', 'show')->name('user.show');
        Route::get('{id}/edit', 'edit')->name('user.edit');
        Route::patch('{id}/update', 'update')->name('user.update');
    });
});

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

require __DIR__ . '/auth.php';
