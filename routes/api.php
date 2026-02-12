<?php

use Illuminate\Http\Request;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);

    Route::apiResource('boards', App\Http\Controllers\Api\BoardApiController::class);

    Route::apiResource('boards.cards', App\Http\Controllers\Api\CardApiController::class);

    Route::apiResource('boards.cards.lists', App\Http\Controllers\Api\ListApiController::class);

    Route::apiResource('boards.chat', App\Http\Controllers\Api\ChatApiController::class)
        ->only(['index', 'store', 'show', 'destroy']);

    Route::prefix('boards/{board}')->group(function () {

        Route::get('/users', [App\Http\Controllers\Api\BoardUserApiController::class, 'index']);
        Route::post('/users', [App\Http\Controllers\Api\BoardUserApiController::class, 'store']);
        Route::delete('/users/{user}', [App\Http\Controllers\Api\BoardUserApiController::class, 'destroy']);
    });
});