<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class DashboardController
{
    public function index(){



        $from = "";
        if(auth()->user()->role === 'manager'){
        $pending_expense = Expense::where('status','pending')->sum('amount');
        $approved_expense = Expense::where('status','approved')
                                    ->whereMonth('created_at',now()->month)
                                    ->whereYear('created_at',now()->year)->sum('amount');
        $from = 'Manager';
        }
        if(auth()->user()->role === 'employee'){
        $pending_expense = Expense::where('status','pending')
                                    ->where('user_id',auth()->user()->id)
                                    ->sum('amount');
        $approved_expense = Expense::where('status','approved')
                                    ->where('user_id',auth()->user()->id)
                                    ->whereMonth('created_at',now()->month)
                                    ->whereYear('created_at',now()->year)->sum('amount');
        $from = 'Employee';
        }


        return response()->json([
            'status' => 'success',
            'message' => $from.' dashboard loaded',
            'data' => [
                'total pending expenses' => $pending_expense,
                'total expense last 30 days' => $approved_expense    
            ]
        ]);
    }
}
