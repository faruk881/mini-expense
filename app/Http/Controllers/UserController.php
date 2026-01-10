<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'All users loaded'
        // ]);

        return UsersResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'message' => 'from show'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => 'from update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            return response()->json([
            'message' => 'from destroy'
        ]);
    }
}
