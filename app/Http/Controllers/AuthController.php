<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function register(Request $request) {
        $userFields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $userFields['password'] = Hash::make($userFields['password']);

        User::create($userFields);

        return response()->json([
            'status' => 'success',
            'message' => 'New user created.'
        ]);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,
        $user->password)) {
            return response()->json([
                'message' => "invalid credentials",

            ]);
        }

        $token = $user->createToken($user->name);

        return response()->json([
            'status' => 'Success',
            'message' => 'User Logged In',
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
}
