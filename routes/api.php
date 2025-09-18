<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Middleware\SetUpLanguageMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => SetUpLanguageMiddleware::class, 'prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
});
