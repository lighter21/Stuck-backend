<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::get('test', function () {
    return "WORKS";
})->name('test');


Route::prefix('auth')->group(function () {
    Route::get('sanctum/csrf-cookie', '\Laravel\Sanctum\Http\Controllers\CsrfCookieController@show')->name('csrf-cookie');
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ForgotPasswordController::class, 'reset']);
});

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::get('user', [LoginController::class, 'me']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


