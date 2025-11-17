<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\EventController;
use App\Http\Controllers\api\v1\EventFormController;
use App\Http\Middleware\EmailVerifiedMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => 'throttle:60,1'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('verify-email', [AuthController::class, 'verifyEmail']);


    Route::group(['middleware' => ['auth:sanctum', EmailVerifiedMiddleware::class]], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::apiResource('events', EventController::class);
        Route::apiResource('event_forms', EventFormController::class);
        Route::get('events/{event}/forms', [EventFormController::class, 'eventForms']);
    });
});
