<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use PDOException;
use Exception;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function index() : View
    {
        return view('home');
    }

    public function show() : JsonResponse
    {
        try {
            $this->data = [Project::with('user')->orderBy('created_at', 'desc')->get(), 200];
        } catch (PDOException $e) {
            $this->data = [$e->getMessage(), 500];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500];
        } finally {
            return $this->respond();
        }
    }

    public function by_id(Request $request) : JsonResponse
    {
        try {
            $this->data = [Project::with('user')->find($request->id), 200];
        } catch (PDOException $e) {
            $this->data = [$e->getMessage(), 500];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500];
        } finally {
            return $this->respond();
        }
    }

    public function create(Request $request) : JsonResponse
    {
        // Create rules for new Project
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|image|mimes:jpg,png,jpeg|max:2048",
            "public" => "required"
        ]);
        // Validate new Project values with Validator
        if ($validator->fails()) {
            $this->data = [$validator->errors(), 400];
            return $this->respond();
        }

        // If all values are valid, then save the image
        $img_route = $request->image->store('images', 'public');

        // And insert new Project
        $params = [
            "title" => $request->title,
            "description" => $request->description,
            "image" => $img_route,
            "public" => $request->public,
            "id_created_by" => auth()->user()->id
        ];
        try {
            $this->data = [Project::create($params), 200];
        } catch (PDOException $e) {
            $this->data = [$e->getMessage(), 500];
        } catch (Exception $e) {
            $this->data = [$e->getMessage(), 500];
        } finally {
            return $this->respond();
        }
    }
}
