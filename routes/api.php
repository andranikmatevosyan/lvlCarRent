<?php

use App\Http\Controllers\Car\CarRentController;
use App\Http\Controllers\User\UserDriveController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->name('user.')->group(function () {
    Route::prefix('{user:id}')->group(function () {
        Route::get('drive', UserDriveController::class)->name('drive');
    });
});

Route::prefix('car')->name('car.')->group(function () {
    Route::prefix('{car:id}')->group(function () {
        Route::post('rent', CarRentController::class)->name('rent');
    });
});
