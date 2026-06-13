<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\StockInController;
use App\Http\Controllers\Api\StockOutController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->group(function () {
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
    Route::put('/items/{item}/stock', [ItemController::class, 'updateStock']);

    Route::get('/stock-ins', [StockInController::class, 'index']);
    Route::get('/stock-ins/latest', [StockInController::class, 'latest']);

    Route::get('/stock-outs', [StockOutController::class, 'index']);
    Route::get('/stock-outs/latest', [StockOutController::class, 'latest']);
});
