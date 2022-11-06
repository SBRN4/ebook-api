<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
        public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    public function login(Request $request)
    {
    if (!Auth::attempt($request->only('email', 'password'))) {
    return response()->json([
    'message' => 'Invalid login details'
               ], 401);
           }
    
    $user = User::where('email', $request['email'])->firstOrFail();
    
    $token = $user->createToken('auth_token')->plainTextToken;
    
    return response()->json([
               'access_token' => $token,
               'token_type' => 'Bearer',
    ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}


