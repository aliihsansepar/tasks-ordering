<?php

    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    /*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });*/
    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/order', [\App\Http\Controllers\TaskController::class, 'order'])->name('order');
        Route::post('/create', [\App\Http\Controllers\TaskController::class, 'store'])->name('store');
        Route::post('/add-prerequisites', [\App\Http\Controllers\TaskController::class, 'addPrerequisites'])->name('addPrerequisites');
    });
