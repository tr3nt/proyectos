<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Create rules for new user
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]);

        // Validate new user values with Validator
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // If all values are valid, then insert new User
        $params = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];
        $user = User::create($params);

        // Create Token
        $token = $user->createToken("auth_token")->plainTextToken;

        // Returns full response
        return response()->json([
            "data" => $user,
            "access_token" => $token,
            "token_type" => "Bearer"
        ]);
    }

    public function login(Request $request)
    {
        // Create rules for login
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8"
        ]);

        // Validate login values with Validator
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // If all values are valid, then try to login
        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json([
                "message" => "Unauthorized"
            ], 401);
        } else {
            $user = User::where("email", $request["email"])->firstOrFail();
            // Create Token
            $token = $user->createToken("auth_token")->plainTextToken;
            // Return the logged user data
            return response()->json([
                "message" => "Hi {$user->name}",
                "accessToken" => $token,
                "token_type" => "Bearer",
                "user" => $user
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        // Remove all active tokens
        auth()->user()->tokens()->delete();
        // Return successs message
        return ["message" => "Successfully logged out"];
    }
}
