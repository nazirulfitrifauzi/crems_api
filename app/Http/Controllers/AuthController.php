<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|unique:users|regex:/(.*)csc\.net\.my$/i',
            'password' => 'required|string|confirmed'
        ],[
            'email.regex' => 'We appreciate your interest on using our System. However at the moment we offer this service only to our company!'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('CremsToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'status' => 201
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid email/password.'
            ], 401);
        }

        $token = $user->createToken('CremsToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'status' => 201
        ];

        return response($response, 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out',
            'code' => 201
        ];
    }
}
