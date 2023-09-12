<?php

namespace App\Livewire\Project;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Jobs\SendMailJob;
use App\Models\Project;

class Create extends Component
{
    // Activate upload files
    use WithFileUploads;

    // Define Project parameters
    public string $title;
    public string $description;
    public $image;
    public int $public;
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'public' => 'required'
    ];

    public function create()
    {
        // Validate input values
        $this->validate();
        // Save the image
        $imgRoute = Storage::disk('public')->put('images', $this->image);
        // And insert new Project
        $params = [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imgRoute,
            'public' => $this->public,
            'users_id' => auth()->user()->id
        ];
        Project::create($params);
        session()->flash('message', 'Project created successfully');
        // Redirect to Projects list
        $this->redirect(Show::class);
    }

    public function render() : View
    {
        return view('livewire.project.create')
            ->extends('layouts.layout')
            ->section('content');
    }
}
