<?php

namespace App\Livewire\Project;

use Illuminate\Contracts\View\View;
use App\Models\Project;
use Livewire\Component;

class Index extends Component
{
    public Project $project;
    public int $public;

    // Get a project by id
    public function mount(int $id)
    {
        $this->project = Project::find($id);
        $this->public = $this->project->public;
    }

    public function update() : void
    {
        $this->project->public = $this->public;
        // Toggle status and send delayed Email by observer
        $this->project->save();
        // Redirect to Project list
        $this->redirect(Show::class);
    }

    public function deleteById() : void
    {
        // Could not use $this->project because a persistency error after delete
        $project = Project::find($this->project->id);
        // Delete project from database (file will be deleted by observer)
        $project->delete();
        // Redirect to projects list
        $this->redirect(Show::class);
    }

    public function render() : View
    {
        return view('livewire.project.index')
            ->extends('layouts.layout')
            ->section('content');
    }
}
