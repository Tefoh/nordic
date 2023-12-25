<?php

use App\Http\Controllers\API\v1\AddMoneyController;
use Illuminate\Support\Facades\Route;

Route::post('add-money', [AddMoneyController::class, 'store'])->name('add-money');
