<?php

namespace App\Livewire\Project;

use Illuminate\Contracts\View\View;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;
    public Project $project;
    public array $form = [];
    protected array $rules = [
        'form.title' => 'required|string|max:255',
        'form.description' => 'required|string',
        'form.public' => 'required'
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->form = $this->project->toArray();
    }

    public function update()
    {
        $this->validate();
        if ($this->form['image'] instanceof UploadedFile) {
            $imgRoute = Storage::disk('public')->put('images', $this->form['image']);
            $this->form['image'] = $imgRoute;
        }
        $this->project->update($this->form);
        session()->flash('message', "Project {$this->project->title} updated successfully");
        return redirect(route('home'));
    }

    public function render() : View
    {
        return view('livewire.project.show')
            ->extends('layouts.layout')
            ->section('content');
    }
}