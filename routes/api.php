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


Route::apiResource('sliders', App\Http\Controllers\SliderController::class);


Route::apiResource('intros', App\Http\Controllers\IntroController::class);


Route::apiResource('abouts', App\Http\Controllers\AboutController::class);


Route::apiResource('abouts', App\Http\Controllers\AboutController::class);


Route::apiResource('about-uses', App\Http\Controllers\AboutUsController::class);


Route::apiResource('about-us-galleries', App\Http\Controllers\AboutUsGalleryController::class);
