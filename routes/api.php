<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('sanctum/csrf-cookie', '\Laravel\Sanctum\Http\Controllers\CsrfCookieController@show')->name('csrf-cookie');

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('user', [AuthController::class, 'me'])->name('me');
//    Route::post('login', [AuthController::class, 'login'])->name('login');
//    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('register', [AuthController::class, 'register'])->name('register');
    Auth::routes();
});

