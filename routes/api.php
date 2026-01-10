<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseApprovalController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'manager'])->group(function(){
    Route::apiResource('users', UserController::class);
});

Route::middleware(['auth:sanctum'])->apiResource('expenses', ExpenseController::class);

// Expense Category
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('view-expense-category',[ExpenseCategoryController::class,'viewCategory']);


});

// User authentications
Route::post('users/register',[AuthController::class,'register']);
Route::post('users/login',[AuthController::class,'login']);
