<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
     // ✅ API Login and generate Sanctum token
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required'
         ]);
 
         if (!Auth::attempt($request->only('email', 'password'))) {
             return response()->json(['message' => 'Invalid credentials'], 401);
         }
 
         $user = Auth::user();
         $token = $user->createToken('api-token')->plainTextToken;
 
         return response()->json([
             'user' => $user,
             'token' => $token
         ], 200);
     }
 
     // ✅ Logout and delete token
     public function logout(Request $request)
     {
         $request->user()->tokens()->delete(); // Remove all tokens
         return response()->json(['message' => 'Logged out successfully']);
     }
 
     // ✅ Get authenticated user details
     public function user(Request $request)
     {
         return response()->json($request->user());
     }
}
