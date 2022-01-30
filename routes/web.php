<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

    Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'getSignup'])->name('auth.signup');
    Route::post('/signup_process', [\App\Http\Controllers\AuthController::class, 'postSignup'])->name('auth.signup_process');

    Route::get('/signin', [\App\Http\Controllers\AuthController::class, 'getSignin'])->name('auth.signin');
    Route::post('/signin_process', [\App\Http\Controllers\AuthController::class, 'postSignin'])->name('auth.signin_process');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/signout', [\App\Http\Controllers\AuthController::class, 'getSignout'])->name('auth.signout');

    Route::get('/things', [\App\Http\Controllers\ThingsController::class, 'getThings'])->name('things');
    Route::post('/things_process', [\App\Http\Controllers\ThingsController::class, 'postThings'])->name('things_process');

    Route::delete('/things_delete/{id}', [\App\Http\Controllers\ThingsController::class, 'destroyThing'])->name('things.destroy');

    Route::get('/things_update/{id}', [\App\Http\Controllers\ThingsController::class, 'getUpdateThing'])->name('things.update');
    Route::patch('/things_update_process/{id}', [\App\Http\Controllers\ThingsController::class, 'postUpdateThing'])->name('things.update_process');

    Route::get('/another_things', [\App\Http\Controllers\ThingsController::class, 'index'])->name('things.another');
});

