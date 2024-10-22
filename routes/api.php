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


Route::apiResource('animals', App\Http\Controllers\AnimalController::class);


Route::apiResource('animals', App\Http\Controllers\AnimalController::class);


Route::apiResource('visitor-galleries', App\Http\Controllers\VisitorGalleryController::class);


Route::apiResource('topas-galleries', App\Http\Controllers\TopasGalleryController::class);


Route::apiResource('topas-galleries', App\Http\Controllers\TopasGalleryController::class);

Route::apiResource('topas-child-galleries', App\Http\Controllers\TopasChildGalleryController::class);


Route::apiResource('topas-galleries', App\Http\Controllers\TopasGalleryController::class);

Route::apiResource('topas-child-galleries', App\Http\Controllers\TopasChildGalleryController::class);


Route::apiResource('visitor-child-galleries', App\Http\Controllers\VisitorChildGalleryController::class);


Route::apiResource('teams', App\Http\Controllers\TeamController::class);


Route::apiResource('activity-galleries', App\Http\Controllers\ActivityGalleryController::class);


Route::apiResource('jobs', App\Http\Controllers\JobController::class);
