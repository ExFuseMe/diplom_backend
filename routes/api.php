<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\EventController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::apiResource('events', EventController::class);
    });
});
