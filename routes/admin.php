<?php

use App\Http\Controllers\Admin\AdminDepositsController;
use App\Http\Controllers\Admin\AdminImageController;


Route::prefix("deposits")->group(function () {
    Route::get("/pending", [AdminDepositsController::class, "list"]);
    Route::put("/{depositId}/review", [AdminDepositsController::class, "review"]);
    Route::get("/{depositId}/", [AdminDepositsController::class, "find"]);
});

Route::prefix("images")->group(function () {
    Route::get("/{imageId}", [AdminImageController::class, "find"]);
});
