<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use PDOException;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request) : JsonResponse
    {
        // Create rules for new user
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]);

        // Validate new user values with Validator
        if ($validator->fails()) {
            $this->data = [$validator->errors(), 400];
            return $this->respond();
        }

        // If all values are valid, then insert new User
        $params = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        try {
            // Create User
            $user = User::create($params);
            // Create Token
            $token = $user->createToken("auth_token")->plainTextToken;
            $this->data = [$user, 200, $token];
        } catch (PDOException $e) {
            $this->data = [$e->getMessage(), 500, ""];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500, ""];
        } finally {
            return $this->authRespond();
        }
    }

    public function login(Request $request) : JsonResponse
    {
        // Create rules for login
        $validator = Validator::make($request->all(), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8"
        ]);

        // Validate login values with Validator
        if ($validator->fails()) {
            $this->data = [$validator->errors(), 400];
            return $this->respond();
        }

        try {
            // If all values are valid, then try to login
            if (!Auth::attempt($request->only("email", "password"))) {
                $this->data = ["Unauthorized", 401, ""];
            } else {
                $user = User::where("email", $request["email"])->firstOrFail();
                // Create Token
                $token = $user->createToken("auth_token")->plainTextToken;
                // Return the logged user data
                $this->data = [$user, 200, $token];
            }
        } catch (PDOException $e) {
            $this->data = [$e->getMessage(), 500, ""];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500, ""];
        } finally {
            return $this->authRespond();
        }
    }

    public function logout() : JsonResponse
    {
        try {
            // Remove all active tokens
            auth()->user()->tokens()->delete();
            $this->data = ["Successfully logged out", 200];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500];
        } finally {
            return $this->respond();
        }
    }
}
