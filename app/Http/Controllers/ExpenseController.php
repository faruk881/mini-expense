<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validate filters
        $request->validate([
            'status'   => 'nullable|in:pending,approved,rejected',
            'category' => 'nullable|exists:expense_categories,slug',
        ]);

        $user = $request->user(); // Sanctum-safe

        $query = Expense::query();

        // Employee → only own expenses
        if ($user->role === 'employee') {
            $query->where('user_id', $user->id);
        }

        // Apply filters
        if ($request->filled('status')) {
            $query->status($request->status);
        }

        if ($request->filled('category')) {
            $query->category($request->category);
        }

        $expenses = $query->latest()->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Expenses fetched successfully',
            'data'    => ExpenseResource::collection($expenses),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Store image 
        $path = $request->file('image_url')->store('receipts', 'local');

        $expense = Expense::create([
            'user_id' => auth()->id(),
            'expense_category_id' => $data['expense_category_id'],
            'amount' => $data['amount'],
            'description' => $data['description'] ?? null,
            'image_url' => $path,
            'status' => 'pending',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Expense submitted successfully',
            'data'    => $expense,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
