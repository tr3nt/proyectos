<?php

namespace App\Livewire\Project;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Project;

class Create extends Component
{
    use WithFileUploads;
    public array $form = [];
    protected array $rules = [
        'form.title' => 'required|string|max:255',
        'form.description' => 'required|string',
        'form.image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'form.public' => 'required'
    ];

    public function create()
    {
        $this->validate();
        $imgRoute = Storage::disk('public')->put('images', $this->form['image']);
        $this->form['image'] = $imgRoute;
        $this->form['users_id'] = auth()->id();
        Project::create($this->form);
        session()->flash('message', 'Project created successfully');
        return redirect(route('home'));
    }

    public function render() : View
    {
        return view('livewire.project.create')
            ->extends('layouts.layout')
            ->section('content');
    }
}
