<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() : View
    {
        return view('home');
    }

    public function show() : JsonResponse
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return response()->json($projects);
    }

    public function create(Request $request) : JsonResponse {
        // Create rules for new Project
        $validator = Validator::make($request, [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|image|mimes:jpg,png,jpeg|max:2048",
            "public" => "required"
        ]);
        // Validate new Project values with Validator
        if ($validator->fails()) {
            return response()->json([
                    "message" => $validator->errors()
                ], 400);
        }

        // If all values are valid, then save the image
        $route = $request->image->store('images', 'public');

        // And insert new Project
        $params = [
            "title" => $request->name,
            "description" => $request->email,
            "image" => $route,
            "public" => $request->public
        ];
        Project::create($params);

        // Returns view render
        return response()->json([
                "message" => "Project created successfully"
            ], 200);
    }
}
