<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseApprovalController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// User authentications
Route::post('users/register',[AuthController::class,'register']);
Route::post('users/login',[AuthController::class,'login']);


// Expense Category
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('view-expense-category',[ExpenseCategoryController::class,'viewCategory']);
    Route::get('dashboard-status',[DashboardController::class,'index']);

    Route::apiResource('expenses', ExpenseController::class);

    //** FOR MANAGER ROLE **/
    Route::middleware(['manager'])->group(function(){
    Route::apiResource('users', UserController::class);
});
});

