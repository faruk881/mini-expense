<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ApproveExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\ViewExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ViewExpenseRequest $request)
    {
       try{
            $user = $request->user();
            $perPage = $request->input('per_page', 10);
            $query = Expense::query();

            if ($user->role === 'employee') {
                $query->where('user_id', $user->id);
            }
            if ($request->filled('status')) {
                $query->status($request->status);
            }

            if ($request->filled('category')) {
                $query->category($request->category);
            }

            $expenses = $query->latest()->paginate($perPage);

            if ($expenses->isEmpty()) {
                return ApiResponse::error('No records found',404);
            }

            return ExpenseResource::collection($expenses);
        
        }catch(\Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        try{
            $path = $request->file('image_url')->store('receipts', 'public'); // store the image in publicaly
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $data['status'] = 'pending';
            $data['image_url'] = $path;
            $expense = Expense::create($data);

            return ApiResponse::success('Expense submitted successfully', new ExpenseResource($expense));
        } catch(\Throwable $e){
            return ApiResponse::error($e->getMessage());
        }

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
    public function update(ApproveExpenseRequest $request, Expense $expense)
    {

        try{
            $manager = $request->user();
            // Manager cannot approve/reject own expense
            if ($expense->user_id === $manager->id) {
                return ApiResponse::error('You cannot approve or reject your own expense',403);
            }

            if(auth()->user()->role === 'employee') {
                return ApiResponse::error('Only manager can approve expense',403);
            }

            // Prevent re-processing
            if ($expense->status !== 'pending') {
                return ApiResponse::error('Expense has already been processed',422);
            }

            // Update expense
            $expense->update([
                'status'  => $request->status,
                'remarks' => $request->status === 'rejected'
                    ? $request->remarks
                    : null,
            ]);

            return ApiResponse::error("Expense {$request->status} successfully", new ExpenseResource($expense));

        } catch(\Throwable $e){
            return ApiResponse::error($e->getMessage());
        }
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
