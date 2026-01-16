<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id'  => 1
        ]);

        // ✅ Create Sanctum token
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'message' => 'Registered successfully',
            'user'    => $user,
            'token'   => $token
        ], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['message'=>'Invalid credentials'],401);
        }

        $token = $request->user()->createToken('api')->plainTextToken;

        return response()->json(['token'=>$token]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message'=>'Logged out']);
    }
}
