<?php

use App\Http\Controllers\Customer\DepositController;
use App\Http\Controllers\Customer\ImageController;
use App\Http\Controllers\Customer\PurchaseController;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Controllers\Customer\UserBalanceController;


Route::prefix("deposits")->group(function () {
    Route::get("/", [DepositController::class, 'list']);
    Route::get("/{depositId}", [DepositController::class, 'find']);
    Route::post("/", [DepositController::class, 'create']);
});

Route::prefix("purchases")->group(function () {
    Route::get("/", [PurchaseController::class, 'list']);
    Route::post("/", [PurchaseController::class, 'create']);
});

Route::prefix("transactions")->group(function () {
    Route::get("/", [TransactionController::class, 'list']);
});

Route::prefix("images")->group(function () {
    Route::get("/{imageId}", [ImageController::class, 'find']);
});

Route::prefix("user-balance")->group(function () {
    Route::get("/", [UserBalanceController::class, 'show']);
});
