<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChunkUploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {return view('welcome');});

Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::view('login', 'auth.login')->name('adminLogin');
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    });

    Route::middleware(['adminAuth'])->group(function () {
        Route::get('logout', [AuthenticationController::class, 'logout_web'])->name('logout');

        Route::get('dashboard', [AdminController::class, 'dash'])->name('admin.dashboard');
        Route::get('profile',  [AdminController::class, 'edit'])->name('admin.profile');
        Route::post('profile',  [AdminController::class, 'update'])->name('admin.profile.update');

        Route::resource('user',UserController::class);
    });



});

Route::post('upload-chunk',[ChunkUploadController::class,'uploadImageChunk'])->name('uploadImageChunk');

//dd(123);
Route::get('{any?}', function () {return 'no no no'/*view('welcome')*/;})->where('any', '.*');

