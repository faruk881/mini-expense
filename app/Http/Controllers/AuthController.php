<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function register(UserRegisterRequest $request) {
        try{
            $userFields = $request->validated();
            $userFields['password'] = Hash::make($userFields['password']);

            $user = User::create($userFields);

            return ApiResponse::success('New user created',new UsersResource($user));
        } catch(\Throwable $e) {
            return ApiResponse::error($e->getMessage());
            // return $this->error($e->getMessage());
        }

    }

    public function login(UserLoginRequest $request){
        try{
            $user = User::where('email',$request->email)->first();

            if(!$user || !Hash::check($request->password,
            $user->password)) {
                return ApiResponse::error('Invalid credentials');
            }

            $token = $user->createToken($user->name);

            return response()->json([
                'status' => 'Success',
                'message' => 'User Logged In',
                'user' => $user,
                'token' => $token->plainTextToken
            ]);

        } catch (\Throwable $e) {
            return ApiResponse::error($e->getMessage());
        }

        
    }
}
