<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'manager'])->apiResource('users', UserController::class);

// User authentications
Route::post('users/register',[AuthController::class,'register']);
Route::post('users/login',[AuthController::class,'login']);
