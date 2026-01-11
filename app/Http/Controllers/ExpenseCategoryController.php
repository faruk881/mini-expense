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
            $categories = ExpenseCategory::paginate(10);
            return ExpenseCategoryResource::collection($categories)->additional([
                'status' => true,
                'message'=> "Category retrive successfully."
            ]);
        } catch (\Throwable $e) {
            return ApiResponse::error($e->getmessage());
        }

    }
}
