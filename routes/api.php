<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PromptController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\CarouselItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Public APIS
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

// Chat APIs
Route::controller(PromptController::class)->group(function () {
    Route::get('/prompts', 'index');
    Route::post('/prompts', 'store');
});

// Message APIs
Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'index');
    Route::get('/message/{id}', 'show');
    Route::post('/message', 'store');
    Route::put('/message/{id}', 'update');
    Route::delete('/message/{id}', 'destroy');
});

// User Selection
Route::get('/user/selection', [UserController::class, 'selection']);

//Private APIS
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    //Admin APIS
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel', 'index');
        Route::get('/carousel/{id}', 'show');
        Route::post('/carousel', 'store');
        Route::put('/carousel/{id}', 'update');
        Route::delete('/carousel/{id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/{id}', 'show');
        Route::put('/user/{id}', 'update')->name('user.update.name');
        Route::put('/user/email/{id}', 'email')->name('user.update.email');
        Route::put('/user/password/{id}', 'password')->name('user.update.password');
        Route::put('/user/image/{id}', 'image')->name('user.image');
        Route::delete('/user/{id}', 'destroy');
    });

    //User specific APIS
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image');
});



