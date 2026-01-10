<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController
{
    public function viewCategory(){
        $categories = ExpenseCategory::all();
        return response()->json([
            'status' => "Success",
            'message' => "All expense category loaded",
            'data' => ExpenseCategoryResource::collection($categories)
        ]);
    }
}
