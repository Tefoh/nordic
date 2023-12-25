<?php

use App\Http\Controllers\API\v1\AddMoneyController;
use App\Http\Controllers\API\v1\GetBalanceController;
use Illuminate\Support\Facades\Route;

Route::post('add-money', [AddMoneyController::class, 'store'])->name('add-money');
Route::get('get-balance', [GetBalanceController::class, 'index'])->name('get-balance');
