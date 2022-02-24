<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterPostRequest $request) {
        User::create($request->all());
        $user = User::where('email', $request->email)->first();

        return $this->successResponse("Successfully Registered. Please wait to be approved.", [
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        // check email
        $user = User::where('email', $request->email)->first();

        // check password
        if(!$user || !Hash::check($request->password, $user->password)) { // bad cred
            return $this->errorResponse('Invalid email/password.', 401);
        } else if ($user->active == NULL) { // not activated yet
            return $this->errorResponse('Please wait for Admin approval.', 401);
        } else if ($user->active == 2) { // deactivated user
            return $this->errorResponse('Your account has been deactivated..', 401);
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
