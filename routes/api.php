<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\UserController::class, 'create']);
        Route::get('/getAllUsers', [\App\Http\Controllers\Api\UserController::class, 'getAllUsers']);
    });

    Route::prefix('transaction')->group(function () {
        Route::post('/create', [\App\Http\Controllers\Api\TransactionController::class, 'createTransaction']);
    });
});
