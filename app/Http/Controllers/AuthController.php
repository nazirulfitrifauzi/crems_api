<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Requests\LoginRequest;
class AuthController extends Controller
{
    public function register(RegisterPostRequest $request) {
        $user = User::create($request->all());

        $token = $user->createToken('CremsToken')->plainTextToken;

        return $this->successResponse("Successfully login ", [
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        // check email
        $user = User::where('email', $request->email)->first();

        // check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Invalid email/password.', 401);
        }

        $token = $user->createToken('CremsToken')->plainTextToken;

        return $this->successResponse("Successfully login ", [
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return $this->successResponse("Logged Out ",null, 201);
        
    }
}
