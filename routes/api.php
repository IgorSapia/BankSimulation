<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\WithdrawController;





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

Route::prefix('register')->group(function () {
    Route::Post('/store', [UserController::class, 'store']);
});

Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::Get('/', [UserController::class, 'index']);
});

Route::middleware('auth:api')->prefix('my-bank-account')->group(function () {
    Route::Post('/deposit', [DepositController::class, 'store']);
    Route::Get('/balance', [BalanceController::class, 'index']);
    Route::Post('/withdraw', [WithdrawController::class, 'store']);
    Route::Post('/withdraw-to', [WithdrawController::class, 'withdrawTo']);
});
