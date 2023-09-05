<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateProject extends Component
{
    public $title;
    public $description;
    public $image;
    public $public;

    public function create()
    {
        $data = [
            "title" => $this->title,
            "description" => $this->description,
            "image" => $this->image,
            "public" => $this->public
        ];
        
        // Create rules for new Project
        $validator = Validator::make($data, [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|image|mimes:jpg,png,jpeg|max:2048",
            "public" => "required"
        ]);

        // Validate new Project values with Validator
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // If all values are valid, then save the image
        $route = $this->image->store('images', 'public');
        
        // And insert new Project
        $params = [
            "title" => $this->name,
            "description" => $this->email,
            "image" => $route,
            "public" => $this->public
        ];
        Project::create($params);

        // Returns view render
        return view('livewire.created_successs');
    }
}
