<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticationController::class, 'logout_api']);
    Route::apiResource('users', App\Http\Controllers\UserController::class);
});


Route::apiResource('contact-uses', App\Http\Controllers\ContactUsController::class);
