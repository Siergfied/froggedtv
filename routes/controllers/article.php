<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

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
