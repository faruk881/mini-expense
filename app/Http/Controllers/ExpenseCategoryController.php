<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController
{
    public function viewCategory(){
        try{
            $categories = ExpenseCategory::all();
            return ApiResponse::success('All expense category loaded',ExpenseCategoryResource::collection($categories));
        } catch (\Throwable $e) {
            return ApiResponse::error($e->getmessage());
        }

    }
}
