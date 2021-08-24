<?php


use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Authentication\AuthController;


/**
 * API authentication (token) routes
 */
Route::prefix("auth")->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
});

