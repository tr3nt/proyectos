<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authorized routes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', function (Request $request) { return $request->user(); });
    Route::post('create-project', [ProjectController::class, 'create']);
    Route::get('projects', [ProjectController::class, 'show']);
    Route::get('project/{id}', [ProjectController::class, 'by_id']);
    Route::get('logout', [AuthController::class, 'logout']);
});

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);