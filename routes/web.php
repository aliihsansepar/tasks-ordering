<?php

    use Illuminate\Support\Facades\Route;

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('store');
    });
